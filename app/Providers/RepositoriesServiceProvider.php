<?php

namespace App\Providers;

use App\Repositories\News\EloquentNews;
use App\Repositories\Page\EloquentPage;
use App\Repositories\User\EloquentUser;
use App\Repositories\Ward\EloquentWard;
use Illuminate\Support\ServiceProvider;
use App\Repositories\coupon\couponRepository;
use App\Repositories\coupon\Eloquentcoupon;
use App\Repositories\Image\EloquentImage;
use App\Repositories\News\NewsRepository;
use App\Repositories\Page\PageRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Ward\WardRepository;
use App\Repositories\Cart\EloquentPayorder;
use App\Repositories\Config\EloquentConfig;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Cart\EloquentPaydetails;
use App\Repositories\Cart\PayorderRepository;
use App\Repositories\Config\ConfigRepository;
use App\Repositories\Contact\EloquentContact;
use App\Repositories\Content\EloquentContent;
use App\Repositories\Product\EloquentProduct;
use App\Repositories\Cart\PaydetailsRepository;
use App\Repositories\Category\EloquentCategory;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Content\ContentRepository;
use App\Repositories\District\EloquentDistrict;
use App\Repositories\Language\EloquentLanguage;
use App\Repositories\Position\EloquentPosition;
use App\Repositories\Producer\EloquentProducer;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Province\EloquentProvince;
use App\Repositories\Attribute\EloquentAttribute;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\District\DistrictRepository;
use App\Repositories\Language\LanguageRepository;
use App\Repositories\Position\PositionRepository;
use App\Repositories\Producer\ProducerRepository;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\News\EloquentNewsTranslation;
use App\Repositories\Page\EloquentPageTranslation;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Image\EloquentImageTranslation;
use App\Repositories\News\NewsTranslationRepository;
use App\Repositories\Page\PageTranslationRepository;
use App\Repositories\LogActivity\EloquentLogActivity;
use App\Repositories\Image\ImageTranslationRepository;
use App\Repositories\LogActivity\LogActivityRepository;
use App\Repositories\LoginHistory\EloquentLoginHistory;
use App\Repositories\ReplyContact\EloquentReplyContact;
use App\Repositories\Content\EloquentContentTranslation;
use App\Repositories\Product\EloquentProductTranslation;
use App\Repositories\LoginHistory\LoginHistoryRepository;
use App\Repositories\ReplyContact\ReplyContactRepository;
use App\Repositories\Category\EloquentCategoryTranslation;
use App\Repositories\Content\ContentTranslationRepository;
use App\Repositories\Producer\EloquentProducerTranslation;
use App\Repositories\Product\ProductTranslationRepository;
use App\Repositories\Attribute\EloquentAttributeTranslation;
use App\Repositories\Category\CategoryTranslationRepository;
use App\Repositories\Producer\ProducerTranslationRepository;
use App\Repositories\Attribute\AttributeTranslationRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\EloquentCustomer;
use App\Repositories\Advantages\AdvantagesRepository;
use App\Repositories\Advantages\EloquentAdvantages;
class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Bind Provider
        $this->app->bind(UserRepository::class,EloquentUser::class);
        $this->app->bind(LoginHistoryRepository::class,EloquentLoginHistory::class);
        $this->app->bind(LanguageRepository::class,EloquentLanguage::class);
        $this->app->bind(CategoryRepository::class,EloquentCategory::class);
        $this->app->bind(CategoryTranslationRepository::class,EloquentCategoryTranslation::class);
        $this->app->bind(NewsRepository::class,EloquentNews::class);
        $this->app->bind(NewsTranslationRepository::class,EloquentNewsTranslation::class);
        $this->app->bind(PageRepository::class,EloquentPage::class);
        $this->app->bind(PageTranslationRepository::class,EloquentPageTranslation::class);
        $this->app->bind(ContentRepository::class,EloquentContent::class);
        $this->app->bind(ContentTranslationRepository::class,EloquentContentTranslation::class);
        $this->app->bind(PositionRepository::class,EloquentPosition::class);
        $this->app->bind(ImageRepository::class,EloquentImage::class);
        $this->app->bind(ImageTranslationRepository::class,EloquentImageTranslation::class);
        $this->app->bind(ContactRepository::class,EloquentContact::class);
        $this->app->bind(ReplyContactRepository::class,EloquentReplyContact::class);
        $this->app->bind(ConfigRepository::class,EloquentConfig::class);
        $this->app->bind(LogActivityRepository::class,EloquentLogActivity::class);
        $this->app->bind(ProvinceRepository::class,EloquentProvince::class);
        $this->app->bind(DistrictRepository::class,EloquentDistrict::class);
        $this->app->bind(WardRepository::class,EloquentWard::class);
        $this->app->bind(ProducerRepository::class,EloquentProducer::class);
        $this->app->bind(ProducerTranslationRepository::class,EloquentProducerTranslation::class);
        $this->app->bind(AttributeRepository::class,EloquentAttribute::class);
        $this->app->bind(AttributeTranslationRepository::class,EloquentAttributeTranslation::class);
        $this->app->bind(ProductRepository::class,EloquentProduct::class);
        $this->app->bind(ProductTranslationRepository::class,EloquentProductTranslation::class);
        $this->app->bind(PayorderRepository::class,EloquentPayorder::class);
        $this->app->bind(PaydetailsRepository::class,EloquentPaydetails::class);
        $this->app->bind(couponRepository::class,Eloquentcoupon::class);
        $this->app->bind(CustomerRepository::class, EloquentCustomer::class);
        $this->app->bind(AdvantagesRepository::class, EloquentAdvantages::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
