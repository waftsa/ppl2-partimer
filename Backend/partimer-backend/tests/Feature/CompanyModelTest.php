<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Company;

class CompanyModelTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_create_company()
    {
        $compData = [
            'companyName' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('secret'),
            'id' => 10,
            'address' => 'Bandung',
            'verified' => 0,
        ];

        $company = Company::create($compData);

        $this->assertInstanceOf(Company::class, $company);
        $this->assertEquals($compData['companyName'], $company->companyName);
        $this->assertEquals($compData['email'], $company->email);
        $this->assertEquals($compData['id'], $company->id);
        $this->assertEquals($compData['password'], $company->password);
        $this->assertEquals($compData['address'], $company->address);
        $this->assertEquals($compData['verified'], $company->verified);
    }
}
