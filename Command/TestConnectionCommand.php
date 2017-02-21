<?php

namespace MovingImage\Bundle\VM6ApiBundle\Command;

use MovingImage\Client\VM6\Criteria\VideoQueryCriteria;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TestConnectionCommand
 * @package MovingImage\Bundle\VM6ApiBundle\Command
 *
 * @author Robert Szeker <robert.szeker@movingimage.com>
 */
class TestConnectionCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('vm6-api:test-connection')
            ->setDescription('Test connection with the Video Manager 6 API');
    }

    /**
     * Tries to connect to the video manager 6 api.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $client = $this->getContainer()->get('vm6_api.client');
            $client->getVideos(new VideoQueryCriteria());
            $output->writeln('<fg=green;options=bold> ✔ Connecting with the API succeeded.</>');

            return 0;
        } catch (\Exception $e) {
            $output->writeln('<bg=red;fg=white;options=bold> ✘ Connecting with the API failed.</>');
            $output->writeln($e->getMessage());

            return 1;
        }
    }
}