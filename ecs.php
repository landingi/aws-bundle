<?php
declare(strict_types=1);

use PhpCsFixer\Fixer\Basic\NonPrintableCharacterFixer;
use PhpCsFixer\Fixer\Basic\SingleLineEmptyBodyFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\PhpTag\LinebreakAfterOpeningTagFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayListItemNewlineFixer;
use Symplify\CodingStandard\Fixer\ArrayNotation\ArrayOpenerAndCloserNewlineFixer;
use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return ECSConfig::configure()
    ->withParallel(null, 2)
    ->withCache('var/cache/ecs')
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withSets([
        SetList::PSR_12,
        SetList::ARRAY,
        SetList::COMMENTS,
        SetList::DOCBLOCK,
        SetList::SPACES,
        SetList::NAMESPACES,
        SetList::PHPUNIT,
        SetList::STRICT,
        SetList::CLEAN_CODE,
    ])
    ->withPhpCsFixerSets(
        perCS: true
    )
    ->withRules([
        LinebreakAfterOpeningTagFixer::class,
        YodaStyleFixer::class,
        NonPrintableCharacterFixer::class,
    ])
    ->withConfiguredRule(LineLengthFixer::class, ['inline_short_lines' => false])
    ->withConfiguredRule(BlankLineBeforeStatementFixer::class, ['statements' => ['continue', 'declare', 'default', 'exit', 'goto', 'include', 'include_once', 'require', 'require_once', 'return', 'switch', 'throw', 'try']])
    // Attributes can be in the same line when short (#[CurrentUser]), or in separate lines when long (ORMs)
    ->withConfiguredRule(MethodArgumentSpaceFixer::class, ['attribute_placement' => 'ignore'])
    ->withSkip([
        ArrayOpenerAndCloserNewlineFixer::class,    // Single-element arrays in one line are ok
        ArrayListItemNewlineFixer::class,           // Conflicts with StandaloneLineInMultilineArrayFixer (`array` set)
        ClassAttributesSeparationFixer::class,      // Cannot configure this one right
        BlankLineAfterOpeningTagFixer::class,       // Blank line between php tag and declare not allowed
        NotOperatorWithSuccessorSpaceFixer::class,  // `!` without succeeding space is ok
        SingleLineEmptyBodyFixer::class             // Empty class & method bodies should be in separate lines
    ]);
