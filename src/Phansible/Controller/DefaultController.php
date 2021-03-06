<?php

namespace Phansible\Controller;

use Flint\Controller\Controller;
use Michelf\Markdown;
use DateTimeZone;

/**
 * @package Skeleton
 */
class DefaultController extends Controller
{
    /**
     * @return string
     */
    public function indexAction()
    {
        return $this->render('index.html.twig', [
            'config' => array_merge(
                            $this->get('config'),
                            array('timezones' => DateTimeZone::listIdentifiers())
            ),
        ]);
    }

    public function usageAction($doc)
    {
        $docfile = $this->get('docs.path') . DIRECTORY_SEPARATOR . $doc . '.md';

        $content = "";

        if (is_file($docfile)) {
            $content = Markdown::defaultTransform(file_get_contents($docfile));
        }

        return $this->render('docs.html.twig', [
            'content' => $content,
        ]);
    }
}
