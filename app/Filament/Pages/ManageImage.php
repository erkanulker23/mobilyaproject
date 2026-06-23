<?php

namespace App\Filament\Pages;

use App\Settings\ImageSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Pages\SettingsPage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ManageImage extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = ImageSettings::class;

    protected static ?string $navigationLabel = 'Görsel Ayarları';

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('blog_post_images')
                ->heading('Blog Görselleri')
                ->columns(2)
                ->description('Varsayılan blog görsellerinizi buradan yükleyebilirsiniz.')
                ->schema([
                    FileUpload::make('blog_details_image')
                        ->label('Blog details image')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'blog_details_image'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('blog_details_image_mobile')
                        ->label('Blog details image (Mobil)')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'blog_details_image_mobile'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('blog_details_hero')
                        ->label('Blog details hero')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'blog_details_hero'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('blog_details_hero_mobile')
                        ->label('Blog details hero (Mobil)')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'blog_details_hero_mobile'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('blog_listing_image')
                        ->label('Blog listing image')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'blog_listing_image'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('blog_listing_image_mobile')
                        ->label('Blog listing image (Mobil)')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'blog_listing_image_mobile'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                ]),

            Section::make('service_post_images')
                ->heading('Hizmet Görselleri')
                ->columns(2)
                ->description('Varsayılan hizmet görsellerinizi buradan yükleyebilirsiniz.')
                ->schema([
                    FileUpload::make('service_details_image')
                        ->label('Service details image')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'service_details_image'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('service_details_image_mobile')
                        ->label('Service details image (Mobil)')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'service_details_image_mobile'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('service_details_hero')
                        ->label('Service details hero')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'service_details_hero'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('service_details_hero_mobile')
                        ->label('Service details hero (Mobil)')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'service_details_hero_mobile'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('service_listing_image')
                        ->label('Service listing image')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'service_listing_image'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('service_listing_image_mobile')
                        ->label('Service listing image (Mobil)')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'service_listing_image_mobile'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                ]),

            Section::make('contact_page_hero')
                ->heading('İletişim Sayfası Hero Banner')
                ->columns(2)
                ->description('İletişim sayfası için hero banner görsellerinizi buradan yükleyebilirsiniz.')
                ->schema([
                    FileUpload::make('contact_hero')
                        ->label('İletişim Hero Banner')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'contact_hero'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('contact_hero_mobile')
                        ->label('İletişim Hero Banner (Mobil)')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'contact_hero_mobile'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                ]),

            Section::make('blog_category_hero')
                ->heading('Blog Kategori Sayfası Hero Banner')
                ->columns(2)
                ->description('Blog kategori/listing sayfası için hero banner görsellerinizi buradan yükleyebilirsiniz.')
                ->schema([
                    FileUpload::make('blog_category_hero')
                        ->label('Blog Kategori Hero Banner')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'blog_category_hero'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('blog_category_hero_mobile')
                        ->label('Blog Kategori Hero Banner (Mobil)')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'blog_category_hero_mobile'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                ]),

            Section::make('service_listing_hero')
                ->heading('Hizmetler Sayfası Hero Banner')
                ->columns(2)
                ->description('Hizmetler listing sayfası için hero banner görsellerinizi buradan yükleyebilirsiniz.')
                ->schema([
                    FileUpload::make('service_listing_hero')
                        ->label('Hizmetler Hero Banner')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'service_listing_hero'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('service_listing_hero_mobile')
                        ->label('Hizmetler Hero Banner (Mobil)')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'service_listing_hero_mobile'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                ]),

            Section::make('gallery_hero')
                ->heading('Galeri Sayfası Hero Banner')
                ->columns(2)
                ->description('Galeri sayfası için hero banner görsellerinizi buradan yükleyebilirsiniz.')
                ->schema([
                    FileUpload::make('gallery_hero')
                        ->label('Galeri Hero Banner')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'gallery_hero'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('gallery_hero_mobile')
                        ->label('Galeri Hero Banner (Mobil)')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'gallery_hero_mobile'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                ]),

            Section::make('page_hero')
                ->heading('Sayfa Hero Banner')
                ->columns(2)
                ->description('Sayfa için hero banner görsellerinizi buradan yükleyebilirsiniz.')
                ->schema([
                    FileUpload::make('page_hero')
                        ->label('Sayfa Hero Banner')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'page_hero'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('page_hero_mobile')
                        ->label('Sayfa Hero Banner (Mobil)')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'page_hero_mobile'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                ]),

            Section::make('testimonials_hero')
                ->heading('Müşteri Yorumları Sayfası Hero Banner')
                ->columns(2)
                ->description('Müşteri yorumları sayfası için hero banner görsellerinizi buradan yükleyebilirsiniz.')
                ->schema([
                    FileUpload::make('testimonials_hero')
                        ->label('Müşteri Yorumları Hero Banner')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'testimonials_hero'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                    FileUpload::make('testimonials_hero_mobile')
                        ->label('Müşteri Yorumları Hero Banner (Mobil)')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => $this->buildImageName($file, 'testimonials_hero_mobile'),
                        )
                        ->directory('default_images')
                        ->placeholder('Resim Yükle')
                        ->image()
                        ->imageEditor(),
                ]),
        ];
    }

    public function buildImageName(TemporaryUploadedFile $file, $name): string
    {
        $ext = Str::of($file->getMimeType())->explode('/')->last();

        return $name.'.'.$ext;
    }
}
