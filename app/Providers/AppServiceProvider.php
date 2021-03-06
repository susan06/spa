<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Repositories\User\EloquentUser;
use App\Repositories\User\UserRepository;

use App\Repositories\Role\EloquentRole;
use App\Repositories\Role\RoleRepository;

use App\Repositories\Permission\EloquentPermission;
use App\Repositories\Permission\PermissionRepository;

use App\Repositories\Activity\EloquentActivity;
use App\Repositories\Activity\ActivityRepository;

use App\Repositories\Session\EloquentSession;
use App\Repositories\Session\SessionRepository;

use App\Repositories\Banner\EloquentBanner;
use App\Repositories\Banner\BannerRepository;

use App\Repositories\BranchOffice\EloquentBranchOffice;
use App\Repositories\BranchOffice\BranchOfficeRepository;

use App\Repositories\Faq\EloquentFaq;
use App\Repositories\Faq\FaqRepository;

use App\Repositories\Comment\EloquentComment;
use App\Repositories\Comment\CommentRepository;

use App\Repositories\Province\EloquentProvince;
use App\Repositories\Province\ProvinceRepository;

use App\Repositories\Reservation\EloquentReservation;
use App\Repositories\Reservation\ReservationRepository;

use App\Repositories\Message\EloquentMessage;
use App\Repositories\Message\MessageRepository;

use App\Repositories\Company\EloquentCompany;
use App\Repositories\Company\CompanyRepository;

use App\Repositories\MethodPayment\EloquentMethodPayment;
use App\Repositories\MethodPayment\MethodPaymentRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(ActivityRepository::class, EloquentActivity::class); 
        $this->app->singleton(SessionRepository::class, EloquentSession::class);
        $this->app->singleton(BannerRepository::class, EloquentBanner::class);
        $this->app->singleton(BranchOfficeRepository::class, EloquentBranchOffice::class);
        $this->app->singleton(FaqRepository::class, EloquentFaq::class);
        $this->app->singleton(CommentRepository::class, EloquentComment::class);
        $this->app->singleton(ProvinceRepository::class, EloquentProvince::class);
        $this->app->singleton(ReservationRepository::class, EloquentReservation::class);
        $this->app->singleton(MessageRepository::class, EloquentMessage::class);
        $this->app->singleton(CompanyRepository::class, EloquentCompany::class);
        $this->app->singleton(MethodPaymentRepository::class, EloquentMethodPayment::class);
    }
}
