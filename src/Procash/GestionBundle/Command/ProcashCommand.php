<?php

namespace Procash\GestionBundle\Command;

use Procash\GestionBundle\Controller\SaisiFermetureController;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;

class ProcashCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('procash:export')
                ->setDescription('Export csv')
                ->addArgument(
                        'name', InputArgument::OPTIONAL, 'Quel type de cvs voulez exporter'
                )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        $fermetureCtrl = new SaisiFermetureController();
        /** creation repertoire pour ftp * */
        $fermetureCtrl->creationDir("exports");
        $fermetureCtrl->creationDir("exports/encaissements");
        $fermetureCtrl->creationDir("exports/fermetures");
        $fermetureCtrl->creationDir("exports/chiffres_ventes");
        $fermetureCtrl->creationDir("exports/redistributions");

        $ftp_user = $this->getContainer()->getParameter('ftp_user');
        $ftp_pwd = $this->getContainer()->getParameter('ftp_pwd');
        $ftp_host = $this->getContainer()->getParameter('ftp_host');
        $ftp_conn = ftp_connect($ftp_host) or die("Could not connect to $ip");
        $login = ftp_login($ftp_conn, $ftp_user, $ftp_pwd);

        // csv fermetures
        $fermetureCtrl->csvFermeture($em, $ftp_conn);
        // csv chiffre vente
        $fermetureCtrl->csvChiffreVente($em, $ftp_conn);
        // csv redistribution 
        $fermetureCtrl->csvRedistribution($em, $ftp_conn);
        // csv encaissement ou facturation
        $fermetureCtrl->csvEncaissement($em, $ftp_conn);
        ftp_close($ftp_conn);
        $output->writeln("Export avec succès");
    }

}
