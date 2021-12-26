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
            '',
        ], explode(PHP_EOL, $string));
    }
}
