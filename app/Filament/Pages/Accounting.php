<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
// use Filament\Forms\Components\DatePicker;

use Carbon\Carbon;

use App\Models\Order;

use App\Traits\PDFGenerator;

class Accounting extends Page
{
    use PDFGenerator;

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';

    protected static string $view = 'filament.pages.accounting';

    protected static ?string $title = 'Accounting Interface';
 
    protected static ?string $navigationLabel = 'Accounting';
     
    protected static ?string $slug = 'accounting';

    protected static ?string $navigationGroup = 'Seller & Sales';

    protected static ?int $navigationSort = 6;

    protected static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public $invoices_start;
    public $invoices_end;
    public $invoices;

    public function mount()
    {
        $this->invoices = collect([]);
    }

    public function displayInvoices()
    {
        if ($this->invoices_start == null) {
            $this->invoices = collect([]);
        } elseif ($this->invoices_start !== null && $this->invoices_end == null) {
            $this->invoices = Order::where('payment_status', '>=', '2')
                                        ->where('transaction_date', '>=', $this->invoices_start)
                                        ->orderBy('transaction_date', 'desc')
                                        ->get();
        } else {
            $this->invoices = Order::where('payment_status', '>=', '2')
                                    ->where('transaction_date', '>=', $this->invoices_start)
                                    ->where('transaction_date', '<=', $this->invoices_end)
                                    ->orderBy('transaction_date', 'desc')
                                    ->get();
        }
    }
}
