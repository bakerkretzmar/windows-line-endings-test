<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class LineEndingsTest extends TestCase
{
    /** @test */
    public function string_inside_test_always_contains_native_line_endings()
    {
        $string = <<<'FILE'
        <?php

        class Post extends Model
        {
            protected $casts = [
                'email_verified_at' => 'datetime',
            ];
        }
        FILE;

        $this->assertSame([
            '<?php',
            '',
            'class Post extends Model',
            '{',
            '    protected $casts = [',
            "        'email_verified_at' => 'datetime',",
            '    ];',
            '}',
        ], explode(PHP_EOL, $string));
    }

    /**
     * @test
     * @testdox concatenate with PHP_EOL (should always work)
     */
    public function concatenate_with_eol()
    {
        $string = <<<'FILE'
        <?php

        class Post extends Model {}
        FILE;

        $parts = [
            '<?php',
            '',
            'class Post extends Model {}',
        ];

        $this->assertSame($string, implode(PHP_EOL, $parts));
    }

    /**
     * @test
     * @testdox concatenate with '\n' (should work on ubuntu and macos)
     */
    public function concatenate_with_n()
    {
        $string = <<<'FILE'
        <?php

        class Post extends Model {}
        FILE;

        $parts = [
            '<?php',
            '',
            'class Post extends Model {}',
        ];

        $this->assertSame($string, implode("\n", $parts));
    }

    /**
     * @test
     * @testdox concatenate with '\r\n' (should work on windows)
     */
    public function concatenate_with_rn()
    {
        $string = <<<'FILE'
        <?php

        class Post extends Model {}
        FILE;

        $parts = [
            '<?php',
            '',
            'class Post extends Model {}',
        ];

        $this->assertSame($string, implode("\r\n", $parts));
    }
}
