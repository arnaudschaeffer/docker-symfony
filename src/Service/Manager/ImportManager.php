<?php
namespace App\Service\Manager;

use App\Entity\Annotation;
use App\Entity\AnnotationType;
use App\Entity\Entity;
use App\Entity\Import;
use App\Entity\Text;
use App\Repository\AnnotationRepository;
use App\Repository\CategoryRepository;
use App\Repository\ImportRepository;
use App\Repository\TextRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Stopwatch\Stopwatch;

/**
 * Class ImportManager
 * @package App\Service\Manager
 */
class ImportManager
{
    /**
     * @var EntityManagerInterface $em
     */
    protected $em;

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param SplFileInfo $file
     * @param LoggerInterface $logger
     * @return bool
     * @throws \Exception
     */
    public function import(SplFileInfo $file,
                           LoggerInterface $logger)
    {
        $this->file = $file;
        $this->logger = $logger;

        return true;
    }
}