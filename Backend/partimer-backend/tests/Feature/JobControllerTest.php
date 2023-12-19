<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Job;
use App\Models\User;
use App\Models\Company;
use App\Models\Applied_Job;
use App\Models\Admin;

class JobControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserIndex()
    {
        // Acting as an authenticated user
        $this->actingAs(User::factory()->create(), 'web');

        // Act: Make a GET request to the job index endpoint
        $response = $this->get(route('job.index'));

        // Assert: Check for a successful response
        $response->assertSuccessful();

        // Assert: Check that the response contains the expected view
        $response->assertViewIs('Job.index');

        // You may add more assertions based on your application's logic
    }

    public function testCompanyIndex()
    {
        // Acting as an authenticated company
        $this->actingAs(Company::factory()->create(), 'company');

        // Act: Make a GET request to the company job index endpoint
        $response = $this->get(route('company_job.index'));

        // Assert: Check for a successful response
        $response->assertSuccessful();

        // Assert: Check that the response contains the expected view
        $response->assertViewIs('Job.index_company');

        // You may add more assertions based on your application's logic
    }

    public function testCreate()
    {
        // Acting as an authenticated company
        $company = Company::factory()->create();
        $this->actingAs($company, 'company');

        // Act: Make a GET request to the create job endpoint
        $response = $this->get(route('job.create', $company));

        // Assert: Check for a successful response
        $response->assertSuccessful();

        // Assert: Check that the response contains the expected view
        $response->assertViewIs('Job.create');

        // You may add more assertions based on your application's logic
    }

    public function testStore()
    {
        // Acting as an authenticated company
        $company = Company::factory()->create();
        $this->actingAs($company, 'company');

        // Act: Make a POST request to the store job endpoint with valid data
        $response = $this->post(route('job.store', $company), [
            'jobName' => 'Sample Job',
            'kategori' => 'Sample Category',
            'salary' => '10000',
            'jobDesc' => 'Sample Job Description',
            'jobReq' => 'Sample Requirements',
            'status' => 1, // Adjust the status as needed
        ]);

        // Assert: Check for a successful redirect to the company homepage
        $response->assertRedirect(route('company_homepage'));

        // Assert: Check that the job is stored in the database
        $this->assertDatabaseHas('job', [
            'company_id' => $company->id,
            'jobName' => 'Sample Job',
            'Category' => 'Sample Category',
            'Salary' => '10000',
            'jobDesc' => 'Sample Job Description',
            'requirement' => 'Sample Requirements',
            'status' => 1, // Adjust the status as needed
            'approved' => 0,
        ]);
    }

    public function testEdit()
    {
        // Assuming you have a job and an applied job in the database
        $job = Job::factory()->create();
        $user = User::factory()->create();
        $apply = Applied_Job::create([
            'id' => 1,
            'user_id' => $user->id,
            'job_id' => $job->id,
            'status' => $job->status,
        ]);

        // Acting as an authenticated company
        $this->actingAs($job->company, 'company');

        // Act: Make a GET request to the edit job endpoint
        $response = $this->get(route('job.edit', ['job' => $job, 'apply' => $apply]));

        // Assert: Check for a successful response and view data
        $response->assertSuccessful();
        $response->assertViewIs('job.edit');
        $response->assertViewHas('title', 'edit');
        $response->assertViewHas('job', $job);
        $response->assertViewHas('applicant', $apply);
    }

    public function test_update_method()
    {
        // Create a job instance
        $job = Job::factory()->create();
        $this->actingAs(User::factory()->create(), 'company');
        // Prepare test data for the update request
        $requestData = [
            'jobName' => 'Updated Job Name',
            'kategori' => 'Updated Category',
            'salary' => 'Updated Salary',
            'jobDesc' => 'Updated Job Description',
            'jobReq' => 'Updated Job Requirements',
        ];

        // Act: Make a PUT request to the update endpoint
        $response = $this->put(route('job.update', ['job' => $job]), $requestData);

        // Assert: Check for a successful redirect
        $response->assertRedirect(route('job.index'))->assertSessionHas('success', 'Update Success');

        // Assert: Check that the job was updated in the database
        $this->assertDatabaseHas('job', [
            'id' => $job->id,
            'jobName' => 'Updated Job Name',
            'Category' => 'Updated Category',
            'Salary' => 'Updated Salary',
            'jobDesc' => 'Updated Job Description',
            'requirement' => 'Updated Job Requirements',
            'approved' => 0,
        ]);
    }

    public function test_delete_method_deletes_job_and_redirects()
    {
        // Assuming you have a job in the database
        $job = Job::factory()->create();
        $this->actingAs(Company::factory()->create(), 'company');
        // Act: Make a DELETE request to the delete job endpoint
        $response = $this->delete(route('job.delete', $job));

        // Assert: Check for a successful redirect to the company job index
        $response->assertRedirect(route('company_job.index'))->assertSessionHas('success', 'Delete Success');

        // Assert: Check that the job is deleted from the database
        $this->assertDatabaseMissing('job', ['id' => $job->id]);
    }

    public function test_allow_method_updates_job_approval()
    {
        // Create a job in the database
        $job = Job::factory()->create(['approved' => 0]);
        $admin = Admin::create([
            'id' => 1,
            'name' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        $this->actingAs($admin, 'admins');
        // Act: Make a PUT request to the allow endpoint
        $response = $this->put(route('admin.allow', $job));

        // Assert: Check for a successful redirect
        $response->assertRedirect();

        // Assert: Check that the job in the database has been updated
        $this->assertDatabaseHas('job', [
            'id' => $job->id,
            'approved' => 1,
        ]);
    }

    public function test_applicant()
    {
        // Create a job and some applied jobs for testing
        $job = Job::factory()->create();
        $user = User::factory()->create();
        $this->actingAs(Company::factory()->create());
        $apply1 = Applied_Job::create([
            'id' => 1,
            'user_id' => $user->id,
            'job_id' => $job->id,
            'status' => $job->status,
        ]);

        $apply2 = Applied_Job::create([
            'id' => 2,
            'user_id' => $user->id,
            'job_id' => $job->id,
            'status' => $job->status,
        ]);

        // Act: Make a GET request to the applicant method
        $response = $this->get(route('applicant', ['job' => $job]));

        // Assert: Check that the view is the correct one
        $response->assertViewIs('Company.job_applicant');

        // Assert: Check that the view has the required data
        $response->assertViewHas('title', 'Applicant');
        $response->assertViewHas('job', $job);
        $response->assertViewHas('applicant', Applied_Job::all());
    }
}
