<?php
namespace App\Command;

use App\Entity\AnnotationType;
use App\Entity\Entity;
use App\Entity\Import;
use App\Entity\Text;
use App\Repository\CategoryRepository;
use App\Repository\ImportRepository;
use App\Repository\TextRepository;
use App\Service\Manager\ImportManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class ImportTextCommand
 * @package App\Command
 */
class ImportCommand extends Command
{
    /**
     * @var string command name
     */
    protected static $defaultName = 'boilerplate:import';

    /**
     * @var ImportManager $importManager
     */
    protected $importManager;

    /**
     * @var EntityManager $em
     */
    protected $em;

    /**
     * ImportTextCommand constructor.
     * @param KernelInterface $appKernel
     * @param EntityManagerInterface $em
     * @param LoggerInterface $logger
     * @param Finder $finder
     * @param ImportManager $textImportManager
     * @param int $importedMin
     * @param int $importedPourcent
     */
    public function __construct(KernelInterface $appKernel,
                                EntityManagerInterface $em,
                                LoggerInterface $logger,
                                ImportManager $textImportManager)
    {
        $this->em = $em;
        $this->importManager = $textImportManager;
        $this->logger = $logger;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Import into DB')
            ->setDefinition([
                new InputOption(
                    'hide-progress-bar',
                    null,
                    InputOption::VALUE_NONE,
                    "Hide progress bar"),
                new InputOption(
                    'backup',
                    null,
                    InputOption::VALUE_NONE,
                    "Backup files when finish (if not, files won't be removed, use false for development purposes"),
            ])
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Place files into folder %s before running this command');
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $files = [];

        $progress  = new ProgressBar($output, count($files));
        $progress->start();

        $this->importManager->setEntityManager($this->em);

        foreach ($this->finder as $file) {
            try {
                $result = $this->importManager->import($file, $this->logger);
            } catch (\Exception $e) {
                $this->logger->error('[' . $file . '] ' . $e->getMessage());
                $this->logger->error('[' . $file . '] ' . $e->getTraceAsString());
            }
        }

        $this->em->flush();
    }
}