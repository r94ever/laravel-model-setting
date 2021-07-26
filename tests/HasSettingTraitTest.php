<?php

namespace r94ever\LaravelModelSetting\Tests;

use r94ever\LaravelModelSetting\Models\ModelSetting;
use r94ever\LaravelModelSetting\Tests\Model\User;

class HasSettingTraitTest extends TestCase
{
    public function test_save_setting_worked_correctly()
    {
        /** @var User $user */
        $user = User::find(1);

        $user->saveSettings([
            'test_key_1' => 'test_value_1',
            'test_key_2' => 'test_value_2'
        ]);

        $user->load('setting');

        $this->assertInstanceOf(ModelSetting::class, $user->setting);

        $this->assertIsArray($user->setting->settings);

        $this->assertEquals('test_value_1', $user->getSetting('test_key_1'));

        $this->assertNull($user->getSetting('fake_key'));

        $this->assertIsArray($user->getSettings(['test_key_1']));

        $this->assertIsArray($user->getSettings(['test_key_1', 'fake_key']));

        $this->assertNull($user->getSettings(['fake_key']));
    }
}
