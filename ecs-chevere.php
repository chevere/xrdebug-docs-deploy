<?php

/*
 * This file is part of Chevere.
 *
 * (c) Rodolfo Berrios <rodolfo@chevere.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use PhpCsFixer\Fixer\ArrayNotation\NoMultilineWhitespaceAroundDoubleArrowFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use PhpCsFixer\Fixer\Comment\SingleLineCommentStyleFixer;
use PhpCsFixer\Fixer\ControlStructure\IncludeFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionTypehintSpaceFixer;
use PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer;
use PhpCsFixer\Fixer\LanguageConstruct\CombineConsecutiveUnsetsFixer;
use PhpCsFixer\Fixer\NamespaceNotation\NoLeadingNamespaceWhitespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\SingleBlankLineBeforeNamespaceFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ObjectOperatorWithoutWhitespaceFixer;
use PhpCsFixer\Fixer\Semicolon\MultilineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\CompactNullableTypehintFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PhpCsFixer\Fixer\Whitespace\NoSpacesAroundOffsetFixer;
use PhpCsFixer\Fixer\Whitespace\NoWhitespaceInBlankLineFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $header = file_get_contents(__DIR__ . '/.header');
    $parameters->set(Option::SETS, [
        SetList::CLEAN_CODE,
        SetList::PSR_12
    ]);
    $services = $containerConfigurator->services();
    $services->set(HeaderCommentFixer::class)
        ->call('configure', [[
            'header' => $header, 'location' => 'after_open'
        ]]);
    $services->set(DeclareStrictTypesFixer::class);
    $services->set(CompactNullableTypehintFixer::class);
    $services->set(FunctionTypehintSpaceFixer::class);
    $services->set(NoLeadingNamespaceWhitespaceFixer::class);
    $services->set(NoWhitespaceInBlankLineFixer::class);
    $services->set(ReturnTypeDeclarationFixer::class)
        ->call('configure', [[
            'space_before' => 'none'
        ]]);
    $services->set(BlankLineBeforeStatementFixer::class);
    $services->set(ArrayIndentationFixer::class);
    $services->set(CombineConsecutiveUnsetsFixer::class);
    $services->set(ClassAttributesSeparationFixer::class);
    $services->set(MultilineWhitespaceBeforeSemicolonsFixer::class);
    $services->set(SingleQuoteFixer::class);
    $services->set(SingleLineCommentStyleFixer::class);
    $services->set(IncludeFixer::class);
    $services->set(NoMultilineWhitespaceAroundDoubleArrowFixer::class);
    $services->set(NoSpacesAroundOffsetFixer::class);
    $services->set(ObjectOperatorWithoutWhitespaceFixer::class);
    $services->set(SingleBlankLineBeforeNamespaceFixer::class);
    $services->set(TrimArraySpacesFixer::class);
    $services->set(BinaryOperatorSpacesFixer::class)
        ->call('configure', [[
            'align_double_arrow' => false,
            'align_equals' => false,
        ]]);
    $services->set(NoExtraBlankLinesFixer::class)
        ->call('configure', [[
            'curly_brace_block',
            'extra',
            'parenthesis_brace_block',
            'square_brace_block',
            'throw',
            'use',
        ]]);
};
