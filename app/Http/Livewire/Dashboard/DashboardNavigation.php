<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Livewire\WithFileUploads;
use App\Models\ContactMessage;
use App\Models\GeneralCondition;
use App\Models\Kulturpass;
use App\Traits\ArticleAnalyzer;

use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class DashboardNavigation extends Component
{
    use WithFileUploads;
    use ArticleAnalyzer;

    public $section;
    public $couture_wishlisted_articles;
    public $couture_wishlisted_vouchers;
    public $couture_wishlisted_sold_articles;
    public $general_conditions_date;
    public $general_conditions_content;

    // Update user details form
    public $gender;
    public $first_name;
    public $email;
    public $company;
    public $last_name;
    public $phone;
    public $old_password;
    public $new_password;
    public $new_password_confirmation;
    public $show_confirmation;
    public $kulturpass_status;
    public $new_kulturpass;

    // New messages counter
    public $counter;

    // Delete User
    public $delete_confirm;
    public $delete_feedback;
    public $confirm_delete;

    protected $queryString = ['section' => ['except' => '', 'except' => 'overview']];

    protected $listeners = ['wishlistUpdated' => 'getWishlistArticles'];

    protected function rules()
    {
        return [
            "gender" => ['nullable', 'string', 'max:7', Rule::in(['male', 'female', 'neutral'])],
            "first_name" => "nullable|string|max:255",
            "last_name" => "nullable|string|max:255",
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'old_password' => ['nullable', 'string', 'min:6'],
            'new_password' => ['nullable', Rules\Password::defaults()],
            'new_password_confirmation' => ['nullable', Rules\Password::defaults()],
            "delete_confirm" => "nullable|boolean",
            "delete_feedback" => "nullable|string|max:1000",
            "new_kulturpass" => ['nullable', 'mimes:pdf,jpg,jpeg,png,bmp,doc,docx', 'max:6144'],
        ];
    }

    public function mount()
    {
        $this->getWishlistArticles();
        $this->getLastGeneralConditions();
        if ($this->section == 'details') {
            $this->fillUserInfo();
        }
        $this->show_confirmation = 0;
        $this->confirm_delete = 0;

        if (auth()->user()->kulturpasses()->count() == 0) {
            $this->kulturpass_status = 0;
        } elseif (auth()->user()->kulturpasses()->orderBy('created_at', 'desc')->first()->approved == '1') {
            $this->kulturpass_status = 2;
        } else {
            $this->kulturpass_status = 1;
        }

        $this->updateCommunicationsCount();
    }

    public function updateCommunicationsCount()
    {
        $this->counter = 0;
        if (auth()->check()) {
            $email = auth()->user()->email;
            $unread_messages_count = 0;
            foreach (ContactMessage::where('email', $email)->where('closed', '0')->where('is_answered', '1')->get() as $message) {
                if ($message->benuAnswers()->where('seen_by_user', '0')->count() > 0) {
                    $unread_messages_count += $message->benuAnswers()->where('seen_by_user', '0')->count();
                }
            }
            $this->counter = $unread_messages_count;
        }
    }

    public function getWishlistArticles()
    {
        $wishlisted_articles = auth::user()->wishlistArticles;
        $this->couture_wishlisted_articles = collect([]);
        $this->couture_wishlisted_vouchers = collect([]);
        $this->couture_wishlisted_sold_articles = collect([]);
        foreach ($wishlisted_articles as $wishlisted_article) {
            if ($wishlisted_article->name == 'voucher') {
                $this->couture_wishlisted_vouchers->push($wishlisted_article);
            } else {
                if ($this->stock($wishlisted_article) > 0) {
                    $this->couture_wishlisted_articles->push($wishlisted_article);
                } else {
                    $this->couture_wishlisted_sold_articles->push($wishlisted_article);
                }
            }
        }
    }

    public function getLastGeneralConditions()
    {
        $this->general_conditions_date = "";
        $this->general_conditions_content = "";
        $query_string = "content_".app()->getLocale();
        if (GeneralCondition::count() > 0) {
            $this->general_conditions_date = GeneralCondition::orderBy('created_at', 'desc')->first()->created_at->format('d\/m\/Y');
            $this->general_conditions_content = GeneralCondition::orderBy('created_at', 'desc')->first()->$query_string;
        }
    }

    public function acceptNewConditions()
    {
        auth()->user()->last_conditions_agreed = '1';
        auth()->user()->save();
        $this->render();
    }

    public function changeSection(string $section)
    {
        $this->section = $section;
        $this->emit('sectionUpdated');
        if ($section == 'communications') {
            $this->emit('communicationsLoaded'); // Used to reload JS for accordeon behaviour
        }
        if ($section == 'details') {
            $this->fillUserInfo();
        }
    }

    public function updatedNewKulturpass()
    {
        $this->emit('activateInputs'); // Used to reload JS inputs behaviour
    }

    public function fillUserInfo()
    {
        $this->show_confirmation = 0;
        $this->emit('activateInputs'); // Used to reload JS inputs behaviour

        // Prefill user info in form
        if (strtolower(auth()->user()->gender) == 'male') {
            $this->gender = "male";
        } elseif (strtolower(auth()->user()->gender) == 'female') {
            $this->gender = "female";
        } elseif (strtolower(auth()->user()->gender) == 'neutral') {
            $this->gender = "neutral";
        } else {
            $this->gender = "";
        }
        $this->first_name = auth()->user()->first_name;
        $this->last_name = auth()->user()->last_name;
        $this->email = auth()->user()->email;
        if (isset(auth()->user()->company)) {
            $this->company = auth()->user()->company;
        } else {
            $this->company = "";
        }
        if (isset(auth()->user()->phone)) {
            $this->phone = auth()->user()->phone;
        } else {
            $this->phone = "";
        }
        $this->old_password = "";
        $this->new_password = "";
        $this->new_password_confirmation = "";
    }

    public function updatePersonalData() {
        $this->validate();
        if ($this->first_name !== null && $this->first_name !== "") {
            auth()->user()->first_name = ucfirst(strtolower($this->first_name));
        }
        if ($this->last_name !== null && $this->last_name !== "") {
            auth()->user()->last_name = ucfirst(strtolower($this->last_name));
        }
        if ($this->company !== null && $this->company !== "") {
            auth()->user()->company = ucfirst(strtolower($this->company));
        }
        if ($this->email !== null && $this->email !== "") {
            // Check that user email has been updated and does not already exists
            if ($this->email !== auth()->user()->email && User::where('email', $this->email)->count() == 0) {
                auth()->user()->email = ucfirst(strtolower($this->email));
            }
        }
        if ($this->gender !== null && $this->gender !== "") {
            auth()->user()->gender = ucfirst(strtolower($this->gender));
        }
        if ($this->phone !== null && $this->phone !== "") {
            auth()->user()->phone = ucfirst(strtolower($this->phone));
        }

        if ($this->old_password !== "" && $this->old_password !== null) {
            if (Hash::check($this->old_password, auth()->user()->password)) {
                if ($this->new_password !== "" 
                    && $this->new_password !== null 
                    && $this->new_password == $this->new_password_confirmation) {
                    
                    auth()->user()->forceFill([
                        'password' => Hash::make($this->new_password),
                    ]);
                }
            }
        }

        if ($this->new_kulturpass !== null) {
            $user = auth()->user();
            $filename = 'kulturpass-'.$user->id.date('dmYHis').'-'.$user->first_name.'-'.$user->last_name.'.'.$this->new_kulturpass->extension();
            $this->new_kulturpass->storeAs(
                'kulturpasses', $filename, 'local'
            );

            $new_kulturpass = new Kulturpass();
            $new_kulturpass->user_id = $user->id;
            $new_kulturpass->file_name = $filename;
            if($new_kulturpass->save()) {
                $this->new_kulturpass = null;
                if (auth()->user()->kulturpasses()->count() == 0) {
                    $this->kulturpass_status = 0;
                } elseif (auth()->user()->kulturpasses()->orderBy('created_at', 'desc')->first()->approved == '1') {
                    $this->kulturpass_status = 2;
                } else {
                    $this->kulturpass_status = 1;
                }
            }
        }
        
        if (auth()->user()->save()) {
            $this->fillUserInfo();
            $this->show_confirmation = 1;
        }
    }

    public function confirmDelete($status)
    {
        if ($status == 1) {
            $this->confirm_delete = 1;
        } else {
            $this->confirm_delete = 0;
        }
    }

    public function deleteUser()
    {
        $this->validate();
        if ($this->delete_confirm == true) {
            auth()->user()->delete_confirmation = 1;
        }
        if ($this->delete_feedback !== null) {
            auth()->user()->delete_feedback = $this->delete_feedback;
        }
        auth()->user()->save();

        // auth()->user()->addresses()->delete();
        // auth()->user()->kulturpasses()->delete();
        auth()->user()->wishlistArticles()->detach();
        auth()->user()->delete();

        return redirect()->route('home', ['locale' => app()->getLocale()])->with('account-deleted', __('dashboard.delete-confirmation'));
    }

    public function keepInputsActivated()
    {
        $this->emit('activateInputs');
    }

    public function render()
    {
        // Maintain dynamic inputs activated
        $this->keepInputsActivated();
        // In case the wishlist is requested, reload  the data to make sure it is loaded asobjects (necessary for overview component)
        if ($this->section == 'wishlist') {
            $this->getWishlistArticles();
        }
        return view('livewire.dashboard.dashboard-navigation', ['user_badges' =>  auth()->user()->badges]);
    }
}
