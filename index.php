<?php

require __DIR__ . '/vendor/autoload.php';

use App\Hand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\SingleCommandApplication;

(new SingleCommandApplication())
    ->addOption('weary')
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        $rows = [];

        foreach (range(0, 6) as $successDices) {
            $hand = new Hand($successDices, boolval($input->getOption('weary')));
            $rows[$successDices][] = str_repeat('⧫', $successDices) . str_repeat('◊', 6 - $successDices);
            foreach (range(10, 20, 2) as $col => $target) {
                $rows[$successDices][] = str_pad(round($hand->success($target) * 100) . ' %', 5, ' ', STR_PAD_LEFT);
            }
        }

        (new Table($output))
            ->setHeaders(array_merge([''], range(10, 20, 2)))
            ->setRows($rows)
            ->render();
    })
    ->run();
