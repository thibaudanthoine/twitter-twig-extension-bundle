<?php

namespace Thibaud\TwitterTwigExtensionBundle\Tests\Twig;

use Thibaud\TwitterTwigExtensionBundle\Twig\TwitterTwigExtension;

/**
 * @author Thibaud Anthoine <thibaud.a@gmail.com>
 */
class TwitterTwigExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getTests
     */
    public function testCreateButtons($template, $contains)
    {
        $twig = new \Twig_Environment(
            new \Twig_Loader_String(),
            array(
                'cache' => false,
                'autoescape' => false,
                'debug' => true
            )
        );
        $twig->addExtension(new TwitterTwigExtension('en', true, array(
            'share' => array(
                'show_count' => true
            ),
            'follow' => array(
                'username' => 'toto',
                'show_username' => 'toto'
            )
        )));

        try {
            $template = $twig->loadTemplate($template);
            $rendering = $template->render(array());
        }
        catch (Exception $e){
            $this->fail($e->getMessage());
        }

        $this->assertContains($contains, $rendering);
    }

    public function getTests()
    {
        return array(
            array('{{ twitter_button_share() }}', '<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-size="large">Tweet</a>'),
            array('{{ twitter_button_follow() }}', '<a href="https://twitter.com/toto" class="twitter-follow-button" data-show-count="true" data-lang="en" data-size="large">Tweet @toto</a>')
        );
    }
}
