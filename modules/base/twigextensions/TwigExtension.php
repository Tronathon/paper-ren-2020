<?php

namespace modules\base\twigextensions;

use Craft;
use craft\helpers\ArrayHelper;
use craft\helpers\StringHelper;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;
use yii\helpers\Inflector;

class TwigExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'Base';
    }

    /**
     * @inheritdoc
     */
    public function getGlobals(): array
    {
        return [
            'doNotTrack' => $this->doNotTrackGlobal(),
            'currentUrl' => Craft::$app->getRequest()->getAbsoluteUrl(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('ordinalize', [$this, 'ordinalize']),
            new TwigFilter('pluralize', [$this, 'pluralize']),
            new TwigFilter('singularize', [$this, 'singularize']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('classNames', [$this, 'classNames']),
            new TwigFunction('version', [$this, 'version']),
        ];
    }

    /**
     * Detect if the DNT header is set.
     *
     * @return bool
     */
    public function doNotTrackGlobal()
    {
        return isset($_SERVER['HTTP_DNT']) && $_SERVER['HTTP_DNT'] == 1;
    }

    /**
     * Converts number to its ordinal form.
     *
     * @param int $number
     *
     * @return string
     */
    public function ordinalize(int $number): string
    {
        return Inflector::ordinalize($number);
    }

    /**
     * Converts a word to its plural form.
     *
     * @param string $word
     * @param int    $number
     *
     * @return string
     */
    public function pluralize(string $word, int $number = 2): string
    {
        return abs($number) === 1 ? $word : Inflector::pluralize($word);
    }

    /**
     * Converts a word to its singular form.
     *
     * @param string $word
     * @param int    $number
     *
     * @return string
     */
    public function singularize(string $word, int $number = 1): string
    {
        return abs($number) === 1 ? Inflector::singularize($word) : $word;
    }

    /**
     * Version a static file by appending a query string based on a files
     * modification time.
     *
     * @param $filename
     * @param string $basePath
     * @return string
     */
    public function version($filename, $basePath = '@webroot'): string
    {
        $path = Craft::getAlias($basePath, false) . $filename;

        if (!file_exists($path)) {
           return $filename;
        }

        return $filename . '?v=' . filemtime($path);
    }

    /**
     * Generates a string to be used as the value for the html class attribute.
     * It accepts any number of arguments which can be a string, numeric or
     * associative array or a mixture of all three. Associative arrays follow
     * the format class: test. Where class is the classname and test evaluates
     * to a boolean, if falsy the class will be excluded from the output.
     *
     * {{ classNames('foo', 'bar')
     * {{ classNames(['foo', 'bar'])
     * {{ classNames({ 'foo', true })
     *
     * @param mixed ...$args
     * @return null|string
     */
    public function classNames(...$args)
    {
        $values = $this->flatten($args);

        $classString = implode(' ', array_unique($values));

        return StringHelper::collapseWhitespace($classString);
    }

    /**
     * Flattens an array.
     *
     * @param $array
     * @return array
     */
    private function flatten(array $array = []): array
    {
        $result = [];

        if (count($array) === 0) {
            return $result;
        }

        foreach ($array as $item) {
            if (!is_array($item)) {
                $result[] = [ (string)$item ];
            } else if (ArrayHelper::isAssociative($item)) {
                $result[] = array_keys(array_filter($item));
            } else {
                $values = $this->flatten($item);

                foreach ($values as $value) {
                    $result[] = [ $value ];
                }
            }
        }

        return array_merge(...$result);
    }
}
