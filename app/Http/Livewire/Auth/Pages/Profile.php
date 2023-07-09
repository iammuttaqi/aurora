<?php

namespace App\Http\Livewire\Auth\Pages;

use App\Models\Category;
use App\Models\City;
use App\Models\EmployeeRange;
use App\Models\Profile as ModelsProfile;
use App\Models\Role;
use App\Rules\SocialLinksRule;
use App\Traits\SocialLinksTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads, SocialLinksTrait, AuthorizesRequests;

    public $form = [
        'name'                       => null,
        'username'                   => null,
        'contact_person'             => null,
        'address'                    => null,
        'city_id'                    => null,
        'contact_number_1'           => null,
        'contact_number_2'           => null,
        'contact_number_3'           => null,
        'email_1'                    => null,
        'email_2'                    => null,
        'email_3'                    => null,
        'website'                    => null,
        'about'                      => null,
        'logo'                       => null,
        'map_link'                   => null,
        'facebook'                   => null,
        'instagram'                  => null,
        'twitter'                    => null,
        'linkedin'                   => null,
        'category_ids'               => [],
        'employee_range_id'          => null,
        'tax_number'                 => null,
        'business_license'           => null,
        'vat_number'                 => null,
        'payment_terms'              => null,
        'shipping_options'           => null,
        'additional_information'     => null,
        'general_manager_name'       => null,
        'general_manager_email'      => null,
        'sales_manager_name'         => null,
        'sales_manager_email'        => null,
        'hr_manager_name'            => null,
        'hr_manager_email'           => null,
        'it_manager_name'            => null,
        'it_manager_email'           => null,
        'manufacturing_capabilities' => null,
        'certifications'             => null,
    ];

    public $logo = null;

    public function mount($username = null)
    {
        // $this->authorize('viewAny', ModelsProfile::class);

        $profile = ModelsProfile::query()
            ->when($username, function ($query) use ($username) {
                $query->where('username', $username);
            }, function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->select(array_keys($this->form))
            ->first();

        if ($profile) {
            $this->form = $profile->toArray();
        }
    }

    public function render()
    {
        $cities = City::query()
            ->has('country')
            ->whereHas('country', function ($query) {
                $query->where('iso', 'bd');
            })
            ->get();
        $categories      = Category::all();
        $employee_ranges = EmployeeRange::all();

        return view('livewire.auth.pages.profile', compact('cities', 'categories', 'employee_ranges'));
    }

    protected $validationAttributes = [
        'form.name'                       => 'Name',
        'form.contact_person'             => 'Contact Person',
        'form.address'                    => 'Address',
        'form.city_id'                    => 'City',
        'form.contact_number_1'           => 'Contact Number 1',
        'form.contact_number_2'           => 'Contact Number 2',
        'form.contact_number_3'           => 'Contact Number 3',
        'form.email_1'                    => 'Email 1',
        'form.email_2'                    => 'Email 2',
        'form.email_3'                    => 'Email 3',
        'form.website'                    => 'Website',
        'form.about'                      => 'About',
        'form.map_link'                   => 'Google Map Link',
        'form.facebook'                   => 'Facebook',
        'form.instagram'                  => 'Instagram',
        'form.twitter'                    => 'Twitter',
        'form.linkedin'                   => 'Linkedin',
        'form.category_ids'               => 'Business Categories',
        'form.employee_range_id'          => 'Employee Range',
        'form.tax_number'                 => 'TAX Number',
        'form.business_license'           => 'Business License',
        'form.vat_number'                 => 'VAT Number',
        'form.payment_terms'              => 'Payment Terms',
        'form.shipping_options'           => 'Shipping Options',
        'form.additional_information'     => 'Additional Information',
        'form.general_manager_name'       => 'General Manager Name',
        'form.general_manager_email'      => 'General Manager Email',
        'form.sales_manager_name'         => 'Sales Manager Name',
        'form.sales_manager_email'        => 'Sales Manager Email',
        'form.hr_manager_name'            => 'HR Manager Name',
        'form.hr_manager_email'           => 'HR Manager Email',
        'form.it_manager_name'            => 'IT Manager Name',
        'form.it_manager_email'           => 'IT Manager Email',
        'form.manufacturing_capabilities' => 'Manufacturing Capabilities',
        'form.certifications'             => 'Certifications',

        'logo' => 'Logo',
    ];

    protected function rules()
    {
        return [
            'form.name'                       => ['required', 'string', 'max:255'],
            'form.contact_person'             => ['required', 'string', 'max:255'],
            'form.address'                    => ['required', 'string'],
            'form.city_id'                    => ['required', 'integer', 'exists:App\Models\City,id'],
            'form.contact_number_1'           => ['required', 'string', 'max:255'],
            'form.contact_number_2'           => ['nullable', 'string', 'max:255'],
            'form.contact_number_3'           => ['nullable', 'string', 'max:255'],
            'form.email_1'                    => ['required', 'string', 'email', 'max:255'],
            'form.email_2'                    => ['nullable', 'string', 'email', 'max:255'],
            'form.email_3'                    => ['nullable', 'string', 'email', 'max:255'],
            'form.website'                    => ['nullable', 'string', 'url', 'max:255'],
            'form.about'                      => ['required', 'string'],
            'form.logo'                       => ['nullable', 'string', 'max:255'],
            'form.map_link'                   => ['nullable', 'string', 'url', 'max:255'],
            'form.facebook'                   => ['nullable', 'string', new SocialLinksRule('facebook'), 'max:255'],
            'form.instagram'                  => ['nullable', 'string', new SocialLinksRule('instagram'), 'max:255'],
            'form.twitter'                    => ['nullable', 'string', new SocialLinksRule('twitter'), 'max:255'],
            'form.linkedin'                   => ['nullable', 'string', new SocialLinksRule('linkedin'), 'max:255'],
            'form.category_ids'               => ['required', 'array', 'min:1'],
            'form.category_ids.*'             => ['required', 'integer', 'exists:App\Models\Category,id'],
            'form.tax_number'                 => ['nullable', 'string', 'max:255'],
            'form.vat_number'                 => ['nullable', 'string', 'max:255'],
            'form.employee_range_id'          => ['nullable', 'integer', 'exists:App\Models\EmployeeRange,id'],
            'form.business_license'           => ['nullable', 'string'],
            'form.payment_terms'              => ['nullable', 'string'],
            'form.shipping_options'           => ['nullable', 'string'],
            'form.additional_information'     => ['nullable', 'string'],
            'form.general_manager_name'       => ['nullable', 'string', 'max:255'],
            'form.general_manager_email'      => ['nullable', 'string', 'email', 'max:255'],
            'form.sales_manager_name'         => ['nullable', 'string', 'max:255'],
            'form.sales_manager_email'        => ['nullable', 'string', 'email', 'max:255'],
            'form.hr_manager_name'            => ['nullable', 'string', 'max:255'],
            'form.hr_manager_email'           => ['nullable', 'string', 'email', 'max:255'],
            'form.it_manager_name'            => ['nullable', 'string', 'max:255'],
            'form.it_manager_email'           => ['nullable', 'string', 'email', 'max:255'],
            'form.manufacturing_capabilities' => ['nullable', 'string', 'max:255'],
            'form.certifications'             => ['nullable', 'string', 'max:255'],
        ];
    }

    public function label($field)
    {
        return isset($this->validationAttributes[$field]) ? $this->validationAttributes[$field] : null;
    }

    public function required($field)
    {
        if (isset($this->rules()[$field])) {
            return $this->rules()[$field] && in_array('required', $this->rules()[$field]);
        }
    }

    public function update()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $profile = ModelsProfile::query()
                ->has('user')
                ->with('user')
                ->when(in_array(auth()->user()->role->slug, Role::slugsInArray('admin')), function ($query) {
                    $query->where('username', $this->form['username']);
                }, function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
                ->first();

            $this->uploadImage($profile);

            ModelsProfile::updateOrCreate(
                ['user_id' => $profile && $profile->user ? $profile->user->id : auth()->user()->id],
                $this->form
            );

            DB::commit();
            $this->dispatchBrowserEvent('banner-message', [
                'style'   => 'success',
                'message' => 'Profile updated!',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            logger(__METHOD__, [$th]);
            $this->dispatchBrowserEvent('banner-message', [
                'style'   => 'danger',
                'message' => 'Failed.',
            ]);
            throw $th;
        }
    }

    private function uploadImage($profile)
    {
        if ($this->logo) {
            if ($profile && $profile && $profile->logo && $profile->logo != $profile->default_logo && file_exists($profile->logo)) {
                unlink($profile->logo);
            }
            $filename = 'logo/logo-' . time() . rand() . '.png';
            if (app()->isProduction()) {
                $this->logo->storeAs('storage', $filename, 'public_html');
            } else {
                $this->logo->storeAs('public', $filename);
            }

            $this->form['logo'] = 'storage/' . $filename;
        }
    }
}
