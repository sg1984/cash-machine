<?php

class EndpointsCashMachineTest extends TestCase
{
    public function test_to_get_info()
    {
        $this->get('/');

        $this->assertEquals(
            file_get_contents(storage_path('app/info.md')), $this->response->getContent()
        );
    }

    public function test_to_make_withdraw_of_30()
    {
        $this->json('GET', 'withdraw', ['value' => 20])
            ->seeJson([
                "20.00"
            ]);
    }

    public function test_to_make_withdraw_of_100()
    {
        $this->json('GET', 'withdraw', ['value' => 100])
            ->seeJson([
                "100.00"
            ]);
    }
}