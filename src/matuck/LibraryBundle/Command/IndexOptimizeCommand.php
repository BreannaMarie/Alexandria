<?php
namespace matuck\LibraryBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class IndexOptimizeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('library:index:optimize')
            ->setDescription('Optimizes an index for better search times.')
            ->addArgument('index', InputArgument::REQUIRED, 'Name of index to optimize?')
            ->setHelp('Optimizes an index specified in runtime.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $indexname = $input->getArgument('index');
        $index = $this->getContainer()->get('ivory_lucene_search')->getIndex($indexname);
        /* @var $index \Zend\Search\Lucene\Index */
        $index->optimize();
        $output->writeln(sprintf('%s was optimized successfully', $indexname));
    }
}