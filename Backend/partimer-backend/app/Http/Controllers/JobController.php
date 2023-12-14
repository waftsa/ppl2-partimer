<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class JobController extends Controller
{
    public function user_index()
    {
        if(!auth()->guard('web')->check()){
            return redirect(route('login'));
        }

        $jobs = Job::all();
        return view('Job.index', [
            'title' => 'job',
            'jobs' => $jobs,
            compact('jobs')
        ]);     
    }

    public function company_index()
    {
        if(!auth()->guard('company')->check()){
            return redirect(route('company_login'));
        }

        $jobs = Job::with('company')->get();

        return view('Job.index_company', [
            'title' => 'job',
            'jobs' => $jobs,
            compact('jobs')
        ]);     
    }

    public function create(Company $company)
    {
        if(!auth()->guard('company')->check()){
            return redirect(route('user_homepage'));
        }
        return view('Job.create', [
            'title' => 'create',
            'company' => $company
        ]);
    }

    public function store(Company $company,Request $req)
    {
        $req->validate([
            'jobName' => 'required',
            'kategori' => 'required',
            'salary' => 'required',
            'jobDesc' => 'required',
            'jobReq' => 'required'
        ]);

        $data['company_id'] = $company->id;
        $data['jobName'] = $req->jobName;
        $data['Category'] = $req->kategori;
        $data['Salary'] = $req->salary;
        $data['jobDesc'] = $req->jobDesc;
        $data['requirement'] = $req->jobReq;
        $data['status'] = 1;
        $data['approved'] = 0;
        $newJob = Job::create($data);

        return redirect(route('company_homepage'));
    }

    public function edit(Job $job)
    {
        return view('job.edit',[
            'title' => 'edit',
            'job' => $job
        ]);
    }

    public function update(Job $job, Request $req)
    {
        $req->validate([
            'jobName' => 'required',
            'kategori' => 'required',
            'salary' => 'required',
            'jobDesc' => 'required',
            'jobReq' => 'required'
        ]);

        $data['jobName'] = $req->jobName;
        $data['Category'] = $req->kategori;
        $data['Salary'] = $req->salary;
        $data['jobDesc'] = $req->jobDesc;
        $data['requirement'] = $req->jobReq;
        $data['avail'] = 1;

        $job->update($data);
        return redirect(route('job.index'))->with('success', 'Update Success');
    }

    public function delete(Job $job)
    {
        $job->delete();
        return redirect(route('job.index_company'))->with('success', 'Delete Success'); 
    }
}
