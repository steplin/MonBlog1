<?php

namespace Router;

/**
 *
 * @author BRIERE Stéphane <stephanebriere@gdpweb.fr>
 */
class Page
{
    protected $content = null;
    protected $pathTemplate = 'Src/Views/Templates';
    protected $pathView;
    protected $fileView;
    protected $session;
    protected $vars = [];

    /**
     *
     * @param type $session
     */
    public function __construct($session)
    {
        $this->session = $session;
    }

    /**
     *
     * @param type $var
     * @param type $value
     */
    public function addVar($var, $value)
    {
        $this->vars[$var] = $value;
    }

    /**
     *
     * @param type $file
     */
    public function setFileView($file)
    {
        $this->fileView = $file;
    }

    /**
     *
     * @param type $file
     */
    public function setPathView($file)
    {
        $this->pathView = $file;
    }

    public function getPage()
    {
        $loader = new \Twig_Loader_Filesystem(
            array(
            $this->pathTemplate,
            $this->pathView
            )
        );
        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new \Twig_Extensions_Extension_Text());
        $twig->addExtension(new \Twig_Extension_Debug());

        $this->addVar('view', $this->fileView);
        $this->addVar('session', $this->session);

        echo $twig->render($this->fileView, $this->vars);
    }
}
