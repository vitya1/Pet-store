<?php
require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Output\OutputInterface;
use Petstore\App\{RevenueReport, ShowroomPetsList};

$app = new Silly\Application();

$app->command('revenue', function(OutputInterface $output) {
    $command = new RevenueReport();
    $output->writeln($command->handle());
})->descriptions('Show petstore revenue report');

$app->command('showroom', function(OutputInterface $output) {
    $command = new ShowroomPetsList();
    $output->writeln($command->handle());
})->descriptions('Show pets that should be in the showroom');

$app->run();
