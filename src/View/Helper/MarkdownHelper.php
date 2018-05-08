<?php
namespace Tanuck\Markdown\View\Helper;

use Cake\View\Helper;
use Cake\Core\Configure;

/**
 * Markdown Helper
 *
 * Render Markdown in your view templates.
 */
class MarkdownHelper extends Helper
{

    /**
     * Default config
     *
     * @var array
     */
    protected $_defaultConfig = [
        'parser' => 'Markdown',
    ];

    /**
     * Parse Markdown input to HTML 5.
     *
     * @param string $input Markdown to be parsed.
     * @return void|string if `$input` is not string return null, otherwise return parsed markdown string
     */
    public function transform($input)
    {
        if (!is_string($input)) {
            return;
        }

        if (!isset($this->parser)) {
            if(Configure::version() >= "3.6.") {
                $className = "cebe\\markdown\\{$this->getConfig('parser')}";
            } else {
                $className = "cebe\\markdown\\{$this->config('parser')}";
            }
            $this->parser = new $className();
            $this->parser->html5 = true;
        }
        return $this->parser->parse($input);
    }
}
