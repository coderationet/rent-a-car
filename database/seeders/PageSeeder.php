<?php

namespace Database\Seeders;

use App\Helpers\Option;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $about = Page::create([
            'name' => 'About',
            'slug' => 'about',
            'content' => 'This is about page',
        ]);

        $terms = Page::create([
            'name' => 'Terms',
            'slug' => 'terms',
            'content' => 'This is terms page',
        ]);

        $bank_transfer_details = Page::create([
            'name' => 'Bank Transfer Details',
            'slug' => 'bank-transfer-details',
            'content' => '<p>This is bank transfer details.<br></p><table class="table table-bordered"><tbody><tr><td>Bank Name</td><td>Account Name</td><td>IBAN</td></tr><tr><td>AKBANK</td><td>CAR RENTAL</td><td>TR68 0000 0000 0000 0000 0000 00<br></td></tr></tbody></table><p>After you complete payment. Contact us from contact page to confirm reservation.</p>',
        ]);

        Option::update('bank_transfer_page_id', $bank_transfer_details->id);
    }
}
