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

        $this->assertEquals([
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
     * @testdox concatenate with PHP_EOL
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

        $this->assertEquals($string, implode(PHP_EOL, $parts));
    }

    /**
     * @test
     * @requires OS FAMILY Darwin|Linux
     * @testdox concatenate with '\n'
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

        $this->assertEquals($string, implode("\n", $parts));
    }

    /**
     * @test
     * @requires OS FAMILY Windows
     * @testdox concatenate with '\r\n'
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

        $this->assertEquals($string, implode("\r\n", $parts));
    }

    /**
     * @test
     * @testdox concatenate with '\n' and replace with PHP_EOL
     */
    public function concatenate_with_n_and_replace()
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

        $imploded = implode("\n", $parts);

        $this->assertEquals($string, preg_replace('/\r?\n/', PHP_EOL, $imploded));
    }

    /**
     * @test
     * @testdox concatenate with '\r\n' and replace with PHP_EOL
     */
    public function concatenate_with_rn_and_replace()
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

        $imploded = implode("\r\n", $parts);

        $this->assertEquals($string, preg_replace('/\r?\n/', PHP_EOL, $imploded));
    }
}
