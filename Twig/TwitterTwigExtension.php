<?php

namespace Thibaud\TwitterTwigExtensionBundle\Twig;

/**
 * Build Twitter twig extension.
 *
 * @author Thibaud Anthoine <thibaud.a@gmail.com>
 */
class TwitterTwigExtension extends \Twig_Extension
{
    /**
     * Language.
     *
     * @var string
     */
    protected $_lang;

    /**
     * Button large size.
     *
     * @var boolean
     */
    protected $_large;

    /**
     * Twitter buttons configuration.
     *
     * @var array
     */
    protected $_buttons;

    /**
     * Default constructor.
     *
     * @param string $lang
     * @param array $buttons
     */
    public function __construct($lang, $large, array $buttons)
    {
        $this->_lang = $lang;
        $this->_large = $large;
        $this->_buttons = $buttons;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'twitter_button_share',
                array($this, 'generateTwitterButtonShare'),
                array(
                    'is_safe' => array('html')
                )
            ),
            new \Twig_SimpleFunction(
                'twitter_button_follow',
                array($this, 'generateTwitterButtonFollow'),
                array(
                    'is_safe' => array('html')
                )
            )
        );
    }

    /**
     *
     * @return string
     */
    protected static function _getFormat()
    {
        return <<<HTML
<a href="%s" class="%s"%s%s%s>%s</a>
<script>%s</script>
HTML;
    }

    /**
     * Generate a twitter share button.
     *
     * @return string
     */
    public function generateTwitterButtonShare()
    {
        return sprintf(
            self::_getFormat(),
            'https://twitter.com/share',
            'twitter-share-button',
            '',
            $this->_getAttribute('lang'),
            $this->_getAttribute('size'),
            $this->_getButtonText(),
            $this->_getTwitterJs()
        );
    }

    /**
     * Generate a twitter follow button.
     *
     * @return string
     */
    public function generateTwitterButtonFollow()
    {
        return sprintf(
            self::_getFormat(),
            sprintf('https://twitter.com/%s', $this->_buttons['follow']['username']),
            'twitter-follow-button',
            $this->_getAttribute('show-count'),
            $this->_getAttribute('lang'),
            $this->_getAttribute('size'),
            ($this->_buttons['follow']['show_username'])
                ? sprintf('%s @%s',
                    $this->_getButtonText(),
                    $this->_buttons['follow']['username']
                )
                : $this->_getButtonText(),
            $this->_getTwitterJs()
        );
    }

    /**
     * Build custom data attribute.
     *
     * @return string
     */
    protected function _getAttribute($name)
    {
        $attribute = '';

        switch($name) {
            case 'show-count':
                $attribute = ($this->_buttons['share']['show_count'])
                    ? ' data-show-count="true"'
                    : ' data-show-count="false"';
                break;
            case 'size':
                $attribute = ($this->_large)
                    ? ' data-size="large"'
                    : '';
                break;
            case 'lang':
                $attribute = ($this->_lang)
                    ? sprintf(' data-lang="%s"', $this->_lang)
                    : '';
                break;
        }

        return $attribute;
    }

    /**
     * Return the button label.
     *
     * @todo Translation...
     *
     * @return string
     */
    protected function _getButtonText()
    {
        return 'Tweet';
    }

    /**
     * Return the twitter javascript.
     *
     * @return string
     */
    protected function _getTwitterJs()
    {
        return <<<JS
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
JS;
    }

    public function getName()
    {
        return 'twitter_twig_extension';
    }
}
