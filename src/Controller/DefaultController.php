<?php

namespace App\Controller;

use App\Entity\AnnotationType;
use App\Entity\Entity;
use App\Entity\Facet;
use App\Entity\Text;
use App\Form\SearchType;
use App\Repository\CategoryRepository;
use App\Repository\FacetRepository;
use App\Repository\TextRepository;
use App\Service\Manager\ImportTextManager;
use App\Service\SolrService;
use App\Utils\DateUtils;
use Http\Client\Exception;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Solarium\Component\Result\Highlighting\Result as HighlightResult;
use Solarium\Exception\HttpException as SolariumHttpException;
use Solarium\QueryType\Select\Result\Result;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\VarDumper\VarDumper;

class DefaultController extends BaseController
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var KernelInterface
     */
    protected $appKernel;

    protected $customVariable;

    /**
     * SearchController constructor.
     * @param KernelInterface $appKernel
     * @param LoggerInterface $logger
     * @param int $solrSnippet
     */
    public function __construct(KernelInterface $appKernel,
                                LoggerInterface $logger,
                                $customVariable = null)
    {
        $this->appKernel = $appKernel;
        $this->logger = $logger;

        if ($customVariable != null) {
            $this->customVariable = $customVariable;
        }
    }

    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="index")
     */
    public function indexAction(
        Request $request)
    {
        return $this->render('index/index.html.twig', [
            'test' => 'hello',
        ]);
    }
}
