<?php


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            file_get_contents(resource_path('views/info.md')), $this->response->getContent()
        );
    }
}
