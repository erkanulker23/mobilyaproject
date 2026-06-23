<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Oluşturucu - {{ config('app.name') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SortableJS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .form-builder-container {
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 300px;
            background: #f8fafc;
            border-right: 1px solid #e2e8f0;
            overflow-y: auto;
        }

        .main-content {
            flex: 1;
            background: #ffffff;
            overflow-y: auto;
        }

        .form-canvas {
            min-height: 600px;
            background: #ffffff;
            border: 2px dashed #cbd5e0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px;
        }

        .form-canvas.has-elements {
            border: 1px solid #e2e8f0;
            border-style: solid;
        }

        .field-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 12px;
            cursor: move;
            transition: all 0.2s;
        }

        .field-item:hover {
            border-color: #4299e1;
            box-shadow: 0 2px 4px rgba(66, 153, 225, 0.1);
        }

        .field-item.selected {
            border-color: #4299e1;
            box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.2);
        }

        .field-palette {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 8px;
            margin-bottom: 8px;
            cursor: grab;
            transition: all 0.2s;
        }

        .field-palette:hover {
            background: #f7fafc;
            border-color: #4299e1;
        }

        .field-palette:active {
            cursor: grabbing;
        }

        .field-controls {
            display: none;
            position: absolute;
            top: -8px;
            right: -8px;
            background: #4299e1;
            border-radius: 4px;
            padding: 4px;
            color: white;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            gap: 4px;
        }

        .field-item:hover .field-controls {
            display: flex;
        }

        .field-control {
            width: 20px;
            height: 20px;
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .field-control:hover {
            background: rgba(255,255,255,0.3);
        }

        .column-selector {
            display: flex;
            gap: 4px;
            margin-top: 8px;
        }

        .column-btn {
            width: 30px;
            height: 20px;
            border: 1px solid #d1d5db;
            background: #f9fafb;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            border-radius: 3px;
        }

        .column-btn.active {
            background: #4299e1;
            color: white;
            border-color: #4299e1;
        }

        .bootstrap-grid {
            display: grid;
            gap: 15px;
        }

        .col-12 { grid-column: span 12; }
        .col-6 { grid-column: span 6; }
        .col-4 { grid-column: span 4; }
        .col-3 { grid-column: span 3; }
        .col-2 { grid-column: span 2; }

        .empty-canvas {
            text-align: center;
            color: #718096;
            padding: 60px 20px;
        }

        .empty-canvas i {
            font-size: 48px;
            margin-bottom: 16px;
            color: #cbd5e0;
        }

        .form-preview {
            background: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
        }

        .form-preview input,
        .form-preview textarea,
        .form-preview select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-preview label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 4px;
            font-size: 14px;
        }

        .form-preview .required::after {
            content: ' *';
            color: #ef4444;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .tab-button {
            padding: 8px 16px;
            border: none;
            background: transparent;
            color: #6b7280;
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }

        .tab-button.active {
            color: #4299e1;
            border-bottom-color: #4299e1;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="form-builder-container flex">
        <!-- Sol Sidebar - Form Elemanları -->
        <div class="sidebar">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Form Elemanları</h2>
            </div>

            <!-- Tab Butonları -->
            <div class="flex border-b border-gray-200">
                <button class="tab-button active" data-tab="basic">
                    <i class="fas fa-th-large mr-2"></i>Temel
                </button>
                <button class="tab-button" data-tab="advanced">
                    <i class="fas fa-cogs mr-2"></i>Gelişmiş
                </button>
                <button class="tab-button" data-tab="layout">
                    <i class="fas fa-layer-group mr-2"></i>Düzen
                </button>
            </div>

            <!-- Temel Elemanlar -->
            <div id="basic" class="tab-content active p-4">
                <div class="space-y-2">
                    <!-- Metin Alanları -->
                    <div class="field-palette" data-type="text" data-label="Tek Satır Metin">
                        <div class="flex items-center">
                            <i class="fas fa-font text-blue-500 mr-3"></i>
                            <span class="text-sm font-medium">Tek Satır Metin</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="textarea" data-label="Çok Satır Metin">
                        <div class="flex items-center">
                            <i class="fas fa-align-left text-blue-500 mr-3"></i>
                            <span class="text-sm font-medium">Çok Satır Metin</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="email" data-label="E-posta">
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-500 mr-3"></i>
                            <span class="text-sm font-medium">E-posta</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="phone" data-label="Telefon">
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-500 mr-3"></i>
                            <span class="text-sm font-medium">Telefon</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="number" data-label="Sayı">
                        <div class="flex items-center">
                            <i class="fas fa-hashtag text-blue-500 mr-3"></i>
                            <span class="text-sm font-medium">Sayı</span>
                        </div>
                    </div>

                    <!-- Seçim Alanları -->
                    <div class="field-palette" data-type="select" data-label="Açılır Liste">
                        <div class="flex items-center">
                            <i class="fas fa-list text-green-500 mr-3"></i>
                            <span class="text-sm font-medium">Açılır Liste</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="radio" data-label="Radyo Buton">
                        <div class="flex items-center">
                            <i class="fas fa-dot-circle text-green-500 mr-3"></i>
                            <span class="text-sm font-medium">Radyo Buton</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="checkbox" data-label="Çoklu Seçim">
                        <div class="flex items-center">
                            <i class="fas fa-check-square text-green-500 mr-3"></i>
                            <span class="text-sm font-medium">Çoklu Seçim</span>
                        </div>
                    </div>

                    <!-- Tarih/Saat -->
                    <div class="field-palette" data-type="date" data-label="Tarih">
                        <div class="flex items-center">
                            <i class="fas fa-calendar text-purple-500 mr-3"></i>
                            <span class="text-sm font-medium">Tarih</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="time" data-label="Saat">
                        <div class="flex items-center">
                            <i class="fas fa-clock text-purple-500 mr-3"></i>
                            <span class="text-sm font-medium">Saat</span>
                        </div>
                    </div>

                    <!-- Dosya -->
                    <div class="field-palette" data-type="file" data-label="Dosya Yükleme">
                        <div class="flex items-center">
                            <i class="fas fa-paperclip text-orange-500 mr-3"></i>
                            <span class="text-sm font-medium">Dosya Yükleme</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="image" data-label="Resim Yükleme">
                        <div class="flex items-center">
                            <i class="fas fa-image text-orange-500 mr-3"></i>
                            <span class="text-sm font-medium">Resim Yükleme</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gelişmiş Elemanlar -->
            <div id="advanced" class="tab-content p-4">
                <div class="space-y-2">
                    <div class="field-palette" data-type="rating" data-label="Puan Verme">
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-3"></i>
                            <span class="text-sm font-medium">Puan Verme</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="scale" data-label="Ölçek">
                        <div class="flex items-center">
                            <i class="fas fa-sliders-h text-yellow-500 mr-3"></i>
                            <span class="text-sm font-medium">Ölçek</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="slider" data-label="Kaydırıcı">
                        <div class="flex items-center">
                            <i class="fas fa-sliders-h text-yellow-500 mr-3"></i>
                            <span class="text-sm font-medium">Kaydırıcı</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="signature" data-label="İmza">
                        <div class="flex items-center">
                            <i class="fas fa-signature text-yellow-500 mr-3"></i>
                            <span class="text-sm font-medium">İmza</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Düzen Elemanları -->
            <div id="layout" class="tab-content p-4">
                <div class="space-y-2">
                    <div class="field-palette" data-type="heading" data-label="Başlık">
                        <div class="flex items-center">
                            <i class="fas fa-heading text-gray-500 mr-3"></i>
                            <span class="text-sm font-medium">Başlık</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="paragraph" data-label="Paragraf">
                        <div class="flex items-center">
                            <i class="fas fa-paragraph text-gray-500 mr-3"></i>
                            <span class="text-sm font-medium">Paragraf</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="divider" data-label="Ayırıcı">
                        <div class="flex items-center">
                            <i class="fas fa-minus text-gray-500 mr-3"></i>
                            <span class="text-sm font-medium">Ayırıcı</span>
                        </div>
                    </div>

                    <div class="field-palette" data-type="html" data-label="HTML İçerik">
                        <div class="flex items-center">
                            <i class="fas fa-code text-gray-500 mr-3"></i>
                            <span class="text-sm font-medium">HTML İçerik</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ana İçerik Alanı -->
        <div class="main-content">
            <!-- Üst Bar -->
            <div class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-xl font-semibold text-gray-800">Form Oluşturucu</h1>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200" id="preview-btn">
                                <i class="fas fa-eye mr-1"></i>Önizle
                            </button>
                            <button class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-md hover:bg-green-200" id="save-btn">
                                <i class="fas fa-save mr-1"></i>Kaydet
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200" id="settings-btn">
                            <i class="fas fa-cog mr-1"></i>Ayarlar
                        </button>
                        <button class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700" id="publish-btn">
                            <i class="fas fa-rocket mr-1"></i>Yayınla
                        </button>
                        <a href="/admin/forms" class="px-4 py-2 text-sm bg-red-100 text-red-700 rounded-md hover:bg-red-200">
                            <i class="fas fa-times mr-1"></i>Çıkış
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Canvas -->
            <div class="p-6">
                <div id="form-canvas" class="form-canvas">
                    <div class="empty-canvas">
                        <i class="fas fa-mouse-pointer"></i>
                        <h3 class="text-lg font-medium text-gray-600 mb-2">Form Oluşturmaya Başlayın</h3>
                        <p class="text-gray-500">Sol panelden form elemanlarını buraya sürükleyin</p>
                    </div>
                </div>

                <!-- Gönder Butonu -->
                <div class="mt-6 text-center">
                    <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                        <i class="fas fa-paper-plane mr-2"></i>Gönder
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Ayarları Modal -->
    <div id="settings-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Form Ayarları</h3>
                </div>
                <div class="p-6">
                    <form id="form-settings">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Form Adı</label>
                                <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Form adını girin">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Form Başlığı</label>
                                <input type="text" name="title" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Form başlığını girin">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Açıklama</label>
                                <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Form açıklaması"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gönder Butonu Metni</label>
                                <input type="text" name="submit_button_text" value="Gönder" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Başarı Mesajı</label>
                                <textarea name="success_message" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Form başarıyla gönderildi!">Formunuz başarıyla gönderildi. Teşekkür ederiz!</textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="button" class="px-4 py-2 text-sm text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200" id="close-settings">İptal</button>
                    <button type="button" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-md hover:bg-blue-700" id="save-settings">Kaydet</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Önizleme Modal -->
    <div id="preview-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Form Önizleme</h3>
                </div>
                <div class="p-6">
                    <div id="form-preview" class="form-preview">
                        <!-- Önizleme içeriği buraya gelecek -->
                    </div>
                </div>
                <div class="p-6 border-t border-gray-200 flex justify-end">
                    <button type="button" class="px-4 py-2 text-sm text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200" id="close-preview">Kapat</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alan Düzenleme Modal -->
    <div id="field-edit-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Alan Düzenle</h3>
                </div>
                <div class="p-6">
                    <form id="field-edit-form">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alan Etiketi</label>
                                <input type="text" name="label" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alan Adı</label>
                                <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Placeholder</label>
                                <input type="text" name="placeholder" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Yardım Metni</label>
                                <textarea name="help_text" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="required" id="required" class="mr-2">
                                <label for="required" class="text-sm font-medium text-gray-700">Zorunlu Alan</label>
                            </div>

                            <!-- Bootstrap Column Selector -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Genişlik (Bootstrap Grid)</label>
                                <div class="column-selector">
                                    <div class="column-btn" data-width="12">12</div>
                                    <div class="column-btn" data-width="6">6</div>
                                    <div class="column-btn" data-width="4">4</div>
                                    <div class="column-btn" data-width="3">3</div>
                                    <div class="column-btn" data-width="2">2</div>
                                </div>
                                <input type="hidden" name="width" value="12">
                            </div>

                            <!-- Seçenekler (Select, Radio, Checkbox için) -->
                            <div id="options-section" class="hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Seçenekler</label>
                                <div id="options-container">
                                    <!-- Seçenekler buraya dinamik olarak eklenecek -->
                                </div>
                                <button type="button" id="add-option" class="mt-2 px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200">
                                    <i class="fas fa-plus mr-1"></i>Seçenek Ekle
                                </button>
                            </div>

                            <!-- Rating/Scale ayarları -->
                            <div id="rating-settings" class="hidden">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Değer</label>
                                        <input type="number" name="min_value" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Maximum Değer</label>
                                        <input type="number" name="max_value" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Dosya ayarları -->
                            <div id="file-settings" class="hidden">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Maximum Dosya Boyutu (MB)</label>
                                        <input type="number" name="max_size" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kabul Edilen Tipler</label>
                                        <input type="text" name="accept_types" placeholder="image/*, .pdf" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- HTML İçerik -->
                            <div id="html-content-section" class="hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-2">HTML İçerik</label>
                                <textarea name="html_content" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="button" class="px-4 py-2 text-sm text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200" id="close-field-edit">İptal</button>
                    <button type="button" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-md hover:bg-blue-700" id="save-field-edit">Kaydet</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        class FormBuilder {
            constructor() {
                this.formData = {
                    name: '',
                    title: '',
                    description: '',
                    submit_button_text: 'Gönder',
                    success_message: 'Formunuz başarıyla gönderildi. Teşekkür ederiz!',
                    fields: []
                };
                this.fieldCounter = 0;
                this.selectedField = null;

                this.init();
            }

            init() {
                this.setupEventListeners();
                this.setupDragAndDrop();
                this.setupSortable();
            }

            setupEventListeners() {
                // Tab switching
                document.querySelectorAll('.tab-button').forEach(button => {
                    button.addEventListener('click', (e) => {
                        const tabName = e.currentTarget.dataset.tab;
                        this.switchTab(tabName);
                    });
                });

                // Modal controls
                document.getElementById('settings-btn').addEventListener('click', () => {
                    this.openSettingsModal();
                });

                document.getElementById('close-settings').addEventListener('click', () => {
                    this.closeSettingsModal();
                });

                document.getElementById('save-settings').addEventListener('click', () => {
                    this.saveSettings();
                });

                document.getElementById('preview-btn').addEventListener('click', () => {
                    this.openPreviewModal();
                });

                document.getElementById('close-preview').addEventListener('click', () => {
                    this.closePreviewModal();
                });

                document.getElementById('save-btn').addEventListener('click', () => {
                    this.saveForm();
                });

                document.getElementById('publish-btn').addEventListener('click', () => {
                    this.publishForm();
                });

                // Field edit modal controls
                document.getElementById('close-field-edit').addEventListener('click', () => {
                    this.closeFieldEditModal();
                });

                document.getElementById('save-field-edit').addEventListener('click', () => {
                    this.saveFieldEdit();
                });

                document.getElementById('add-option').addEventListener('click', () => {
                    this.addOptionRow();
                });
            }

            switchTab(tabName) {
                // Remove active class from all tabs and buttons
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                document.querySelectorAll('.tab-button').forEach(button => {
                    button.classList.remove('active');
                });

                // Add active class to selected tab and button
                document.getElementById(tabName).classList.add('active');
                document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
            }

            setupDragAndDrop() {
                const canvas = document.getElementById('form-canvas');

                // Make canvas a drop zone
                canvas.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    canvas.classList.add('border-blue-400', 'bg-blue-50');
                });

                canvas.addEventListener('dragleave', (e) => {
                    canvas.classList.remove('border-blue-400', 'bg-blue-50');
                });

                canvas.addEventListener('drop', (e) => {
                    e.preventDefault();
                    canvas.classList.remove('border-blue-400', 'bg-blue-50');

                    const fieldType = e.dataTransfer.getData('text/plain');
                    if (fieldType) {
                        this.addField(fieldType);
                    }
                });

                // Make field palettes draggable
                document.querySelectorAll('.field-palette').forEach(palette => {
                    palette.draggable = true;
                    palette.addEventListener('dragstart', (e) => {
                        e.dataTransfer.setData('text/plain', e.target.dataset.type);
                    });
                });
            }

            setupSortable() {
                const canvas = document.getElementById('form-canvas');

                new Sortable(canvas, {
                    animation: 150,
                    ghostClass: 'opacity-50',
                    onEnd: (evt) => {
                        // Update field order
                        this.updateFieldOrder();
                    }
                });
            }

            addField(type) {
                this.fieldCounter++;
                const fieldId = `field_${this.fieldCounter}`;

                const fieldData = {
                    id: fieldId,
                    type: type,
                    name: this.generateFieldName(type),
                    label: this.getFieldLabel(type),
                    required: false,
                    placeholder: '',
                    help_text: '',
                    options: this.getDefaultOptions(type),
                    settings: this.getDefaultSettings(type)
                };

                this.formData.fields.push(fieldData);
                this.renderField(fieldData);
                this.updateCanvas();
            }

            generateFieldName(type) {
                const baseName = type.replace(/[^a-z0-9]/g, '_');
                const existingNames = this.formData.fields.map(f => f.name);
                let counter = 1;
                let name = baseName;

                while (existingNames.includes(name)) {
                    name = `${baseName}_${counter}`;
                    counter++;
                }

                return name;
            }

            getFieldLabel(type) {
                const labels = {
                    'text': 'Tek Satır Metin',
                    'textarea': 'Çok Satır Metin',
                    'email': 'E-posta',
                    'phone': 'Telefon',
                    'number': 'Sayı',
                    'select': 'Açılır Liste',
                    'radio': 'Radyo Buton',
                    'checkbox': 'Çoklu Seçim',
                    'date': 'Tarih',
                    'time': 'Saat',
                    'file': 'Dosya Yükleme',
                    'image': 'Resim Yükleme',
                    'rating': 'Puan Verme',
                    'scale': 'Ölçek',
                    'slider': 'Kaydırıcı',
                    'signature': 'İmza',
                    'heading': 'Başlık',
                    'paragraph': 'Paragraf',
                    'divider': 'Ayırıcı',
                    'html': 'HTML İçerik'
                };
                return labels[type] || type;
            }

            getDefaultOptions(type) {
                if (['select', 'radio', 'checkbox'].includes(type)) {
                    return {
                        'option_1': 'Seçenek 1',
                        'option_2': 'Seçenek 2',
                        'option_3': 'Seçenek 3'
                    };
                }
                return {};
            }

            getDefaultSettings(type) {
                const settings = {};

                if (type === 'rating') {
                    settings.min = 1;
                    settings.max = 5;
                } else if (type === 'scale') {
                    settings.min = 1;
                    settings.max = 10;
                } else if (type === 'slider') {
                    settings.min = 0;
                    settings.max = 100;
                } else if (type === 'heading') {
                    settings.heading_level = 'h3';
                } else if (type === 'file' || type === 'image') {
                    settings.max_size = 5;
                    settings.accept = type === 'image' ? ['image/*'] : [];
                }

                return settings;
            }

            renderField(fieldData) {
                const canvas = document.getElementById('form-canvas');
                const fieldElement = this.createFieldElement(fieldData);
                canvas.appendChild(fieldElement);
            }

            createFieldElement(fieldData) {
                const fieldDiv = document.createElement('div');
                fieldDiv.className = 'field-item relative';
                fieldDiv.dataset.fieldId = fieldData.id;

                fieldDiv.innerHTML = `
                    <div class="field-controls">
                        <div class="field-control edit-field" title="Düzenle">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="field-control delete-field" title="Sil">
                            <i class="fas fa-trash"></i>
                        </div>
                    </div>
                    <div class="field-content">
                        ${this.getFieldPreview(fieldData)}
                    </div>
                    <div class="column-selector">
                        <div class="column-btn ${fieldData.width === '12' ? 'active' : ''}" data-width="12">12</div>
                        <div class="column-btn ${fieldData.width === '6' ? 'active' : ''}" data-width="6">6</div>
                        <div class="column-btn ${fieldData.width === '4' ? 'active' : ''}" data-width="4">4</div>
                        <div class="column-btn ${fieldData.width === '3' ? 'active' : ''}" data-width="3">3</div>
                        <div class="column-btn ${fieldData.width === '2' ? 'active' : ''}" data-width="2">2</div>
                    </div>
                `;

                // Add click handler for field selection
                fieldDiv.addEventListener('click', (e) => {
                    if (!e.target.closest('.field-controls')) {
                        this.selectField(fieldData.id);
                    }
                });

                // Add edit handler
                fieldDiv.querySelector('.edit-field').addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.editField(fieldData.id);
                });

                // Add delete handler
                fieldDiv.querySelector('.delete-field').addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.deleteField(fieldData.id);
                });

                // Add column width handlers
                fieldDiv.querySelectorAll('.column-btn').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        this.changeFieldWidth(fieldData.id, btn.dataset.width);
                    });
                });

                return fieldDiv;
            }

            getFieldPreview(fieldData) {
                const { type, label, required, placeholder, options } = fieldData;

                let preview = `<label class="block text-sm font-medium text-gray-700 mb-1">${label}${required ? ' *' : ''}</label>`;

                switch (type) {
                    case 'text':
                    case 'email':
                    case 'phone':
                    case 'number':
                        preview += `<input type="${type}" placeholder="${placeholder || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>`;
                        break;
                    case 'textarea':
                        preview += `<textarea placeholder="${placeholder || ''}" class="w-full px-3 py-2 border border-gray-300 rounded-md" rows="3" disabled></textarea>`;
                        break;
                    case 'select':
                        preview += `<select class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>
                            <option>Seçiniz</option>
                            ${Object.values(options).map(option => `<option>${option}</option>`).join('')}
                        </select>`;
                        break;
                    case 'radio':
                        preview += Object.entries(options).map(([value, label]) =>
                            `<div class="flex items-center mb-1">
                                <input type="radio" name="${fieldData.name}" class="mr-2" disabled>
                                <label class="text-sm">${label}</label>
                            </div>`
                        ).join('');
                        break;
                    case 'checkbox':
                        preview += Object.entries(options).map(([value, label]) =>
                            `<div class="flex items-center mb-1">
                                <input type="checkbox" name="${fieldData.name}[]" class="mr-2" disabled>
                                <label class="text-sm">${label}</label>
                            </div>`
                        ).join('');
                        break;
                    case 'date':
                        preview += `<input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>`;
                        break;
                    case 'time':
                        preview += `<input type="time" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>`;
                        break;
                    case 'file':
                    case 'image':
                        preview += `<input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-md" disabled>`;
                        break;
                    case 'rating':
                        preview += `<div class="flex space-x-1">
                            ${Array.from({length: 5}, (_, i) => `<i class="fas fa-star text-gray-300"></i>`).join('')}
                        </div>`;
                        break;
                    case 'heading':
                        preview = `<h3 class="text-lg font-semibold text-gray-800">${label}</h3>`;
                        break;
                    case 'paragraph':
                        preview = `<p class="text-gray-600">${label}</p>`;
                        break;
                    case 'divider':
                        preview = `<hr class="border-gray-300">`;
                        break;
                    case 'html':
                        preview = `<div class="bg-gray-100 p-3 rounded text-sm text-gray-600">HTML İçerik</div>`;
                        break;
                }

                return preview;
            }

            selectField(fieldId) {
                // Remove selection from all fields
                document.querySelectorAll('.field-item').forEach(item => {
                    item.classList.remove('selected');
                });

                // Select current field
                const fieldElement = document.querySelector(`[data-field-id="${fieldId}"]`);
                if (fieldElement) {
                    fieldElement.classList.add('selected');
                    this.selectedField = fieldId;
                }
            }

            editField(fieldId) {
                const fieldData = this.formData.fields.find(f => f.id === fieldId);
                if (!fieldData) return;

                // Create edit modal
                this.openFieldEditModal(fieldData);
            }

            openFieldEditModal(fieldData) {
                this.currentEditingField = fieldData;

                // Fill form with current field data
                const form = document.getElementById('field-edit-form');
                form.querySelector('[name="label"]').value = fieldData.label || '';
                form.querySelector('[name="name"]').value = fieldData.name || '';
                form.querySelector('[name="placeholder"]').value = fieldData.placeholder || '';
                form.querySelector('[name="help_text"]').value = fieldData.help_text || '';
                form.querySelector('[name="required"]').checked = fieldData.required || false;
                form.querySelector('[name="width"]').value = fieldData.width || '12';

                // Show/hide sections based on field type
                this.toggleFieldEditSections(fieldData.type);

                // Load options if applicable
                if (['select', 'radio', 'checkbox'].includes(fieldData.type)) {
                    this.loadFieldOptions(fieldData.options || {});
                }

                // Load settings
                if (fieldData.settings) {
                    if (fieldData.settings.min !== undefined) {
                        form.querySelector('[name="min_value"]').value = fieldData.settings.min;
                    }
                    if (fieldData.settings.max !== undefined) {
                        form.querySelector('[name="max_value"]').value = fieldData.settings.max;
                    }
                    if (fieldData.settings.max_size !== undefined) {
                        form.querySelector('[name="max_size"]').value = fieldData.settings.max_size;
                    }
                    if (fieldData.settings.accept) {
                        form.querySelector('[name="accept_types"]').value = fieldData.settings.accept.join(', ');
                    }
                    if (fieldData.settings.html_content) {
                        form.querySelector('[name="html_content"]').value = fieldData.settings.html_content;
                    }
                }

                // Show modal
                document.getElementById('field-edit-modal').classList.remove('hidden');
            }

            toggleFieldEditSections(fieldType) {
                // Hide all sections first
                document.getElementById('options-section').classList.add('hidden');
                document.getElementById('rating-settings').classList.add('hidden');
                document.getElementById('file-settings').classList.add('hidden');
                document.getElementById('html-content-section').classList.add('hidden');

                // Show relevant sections
                if (['select', 'radio', 'checkbox'].includes(fieldType)) {
                    document.getElementById('options-section').classList.remove('hidden');
                }
                if (['rating', 'scale', 'slider'].includes(fieldType)) {
                    document.getElementById('rating-settings').classList.remove('hidden');
                }
                if (['file', 'image'].includes(fieldType)) {
                    document.getElementById('file-settings').classList.remove('hidden');
                }
                if (fieldType === 'html') {
                    document.getElementById('html-content-section').classList.remove('hidden');
                }
            }

            loadFieldOptions(options) {
                const container = document.getElementById('options-container');
                container.innerHTML = '';

                Object.entries(options).forEach(([value, label], index) => {
                    this.addOptionRow(value, label, index);
                });

                // Add at least one option if none exist
                if (Object.keys(options).length === 0) {
                    this.addOptionRow('option_1', 'Seçenek 1', 0);
                }
            }

            addOptionRow(value = '', label = '', index = 0) {
                const container = document.getElementById('options-container');
                const optionDiv = document.createElement('div');
                optionDiv.className = 'flex items-center space-x-2 mb-2';
                optionDiv.innerHTML = `
                    <input type="text" name="option_value_${index}" placeholder="Değer" value="${value}" class="flex-1 px-2 py-1 border border-gray-300 rounded text-sm">
                    <input type="text" name="option_label_${index}" placeholder="Etiket" value="${label}" class="flex-1 px-2 py-1 border border-gray-300 rounded text-sm">
                    <button type="button" class="remove-option px-2 py-1 text-red-600 hover:bg-red-100 rounded">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                `;
                container.appendChild(optionDiv);

                // Add remove handler
                optionDiv.querySelector('.remove-option').addEventListener('click', () => {
                    optionDiv.remove();
                });
            }

            deleteField(fieldId) {
                if (confirm('Bu alanı silmek istediğinizden emin misiniz?')) {
                    // Remove from formData
                    this.formData.fields = this.formData.fields.filter(f => f.id !== fieldId);

                    // Remove from DOM
                    const fieldElement = document.querySelector(`[data-field-id="${fieldId}"]`);
                    if (fieldElement) {
                        fieldElement.remove();
                    }

                    // Update canvas
                    this.updateCanvas();
                }
            }

            changeFieldWidth(fieldId, width) {
                // Update field data
                const fieldData = this.formData.fields.find(f => f.id === fieldId);
                if (fieldData) {
                    fieldData.width = width;
                }

                // Update visual indicators
                const fieldElement = document.querySelector(`[data-field-id="${fieldId}"]`);
                if (fieldElement) {
                    fieldElement.querySelectorAll('.column-btn').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    fieldElement.querySelector(`[data-width="${width}"]`).classList.add('active');
                }
            }

            updateFieldDisplay(fieldData) {
                const fieldElement = document.querySelector(`[data-field-id="${fieldData.id}"]`);
                if (fieldElement) {
                    fieldElement.querySelector('.field-content').innerHTML = this.getFieldPreview(fieldData);
                }
            }

            updateFieldOrder() {
                const fieldElements = document.querySelectorAll('.field-item');
                this.formData.fields = Array.from(fieldElements).map((element, index) => {
                    const fieldId = element.dataset.fieldId;
                    const fieldData = this.formData.fields.find(f => f.id === fieldId);
                    fieldData.order = index;
                    return fieldData;
                });
            }

            updateCanvas() {
                const canvas = document.getElementById('form-canvas');
                const emptyCanvas = canvas.querySelector('.empty-canvas');

                if (this.formData.fields.length > 0 && emptyCanvas) {
                    emptyCanvas.remove();
                    canvas.classList.add('has-elements');
                } else if (this.formData.fields.length === 0) {
                    canvas.classList.remove('has-elements');
                    canvas.innerHTML = `
                        <div class="empty-canvas">
                            <i class="fas fa-mouse-pointer"></i>
                            <h3 class="text-lg font-medium text-gray-600 mb-2">Form Oluşturmaya Başlayın</h3>
                            <p class="text-gray-500">Sol panelden form elemanlarını buraya sürükleyin</p>
                        </div>
                    `;
                }
            }

            openSettingsModal() {
                document.getElementById('settings-modal').classList.remove('hidden');
            }

            closeSettingsModal() {
                document.getElementById('settings-modal').classList.add('hidden');
            }

            saveSettings() {
                const form = document.getElementById('form-settings');
                const formData = new FormData(form);

                this.formData.name = formData.get('name');
                this.formData.title = formData.get('title');
                this.formData.description = formData.get('description');
                this.formData.submit_button_text = formData.get('submit_button_text');
                this.formData.success_message = formData.get('success_message');

                this.closeSettingsModal();
                // Form settings saved
            }

            openPreviewModal() {
                const previewContainer = document.getElementById('form-preview');
                previewContainer.innerHTML = this.generateFormPreview();
                document.getElementById('preview-modal').classList.remove('hidden');
            }

            closePreviewModal() {
                document.getElementById('preview-modal').classList.add('hidden');
            }

            generateFormPreview() {
                let preview = `
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">${this.formData.title || 'Form Başlığı'}</h2>
                        ${this.formData.description ? `<p class="text-gray-600">${this.formData.description}</p>` : ''}
                    </div>
                    <div class="bootstrap-grid grid grid-cols-12 gap-4">
                `;

                this.formData.fields.forEach(field => {
                    const colClass = `col-${field.width || '12'}`;
                    preview += `<div class="${colClass}">`;
                    preview += this.getFieldPreview(field);
                    preview += `</div>`;
                });

                preview += `
                    </div>
                    <div class="mt-6">
                        <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                            ${this.formData.submit_button_text}
                        </button>
                    </div>
                `;

                return preview;
            }

            async saveForm() {
                if (!this.formData.name || !this.formData.title) {
                    alert('Lütfen form adı ve başlığını girin.');
                    return;
                }

                if (this.formData.fields.length === 0) {
                    alert('Forma en az bir alan eklemelisiniz.');
                    return;
                }

                try {
                    const response = await fetch('/admin/forms/builder/save', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(this.formData)
                    });

                    const result = await response.json();

                    if (response.ok) {
                        alert('Form başarıyla kaydedildi!');
                        // Form saved

                        // Redirect to form list
                        if (result.form && result.form.admin_url) {
                            window.location.href = result.form.admin_url;
                        } else {
                            window.location.href = '/admin/forms';
                        }
                    } else {
                        throw new Error(result.message || 'Form kaydedilemedi');
                    }
                } catch (error) {
                    // Error saving form
                    alert('Form kaydedilirken hata oluştu: ' + error.message);
                }
            }

            async publishForm() {
                if (this.formData.fields.length === 0) {
                    alert('Forma en az bir alan eklemelisiniz.');
                    return;
                }

                await this.saveForm();
                // Additional publish logic here
                alert('Form yayınlandı!');
            }

            async loadExistingForm(formId) {
                try {
                    const response = await fetch(`/admin/forms/builder/load/${formId}`);
                    if (response.ok) {
                        const formData = await response.json();
                        this.formData = formData;
                        this.renderExistingForm();
                        // Form loaded
                    } else {
                        throw new Error('Form yüklenemedi');
                    }
                } catch (error) {
                    // Error loading form
                    alert('Form yüklenirken hata oluştu.');
                }
            }

            renderExistingForm() {
                // Clear existing fields
                const canvas = document.getElementById('form-canvas');
                canvas.innerHTML = '';

                // Reset field counter
                this.fieldCounter = Math.max(...this.formData.fields.map(f => parseInt(f.id.replace('field_', '')) || 0), 0);

                // Render each field
                this.formData.fields.forEach(fieldData => {
                    this.renderField(fieldData);
                });

                // Update canvas
                this.updateCanvas();

                // Update form settings in modal
                this.updateFormSettings();
            }

            updateFormSettings() {
                const form = document.getElementById('form-settings');
                if (form) {
                    form.querySelector('[name="name"]').value = this.formData.name || '';
                    form.querySelector('[name="title"]').value = this.formData.title || '';
                    form.querySelector('[name="description"]').value = this.formData.description || '';
                    form.querySelector('[name="submit_button_text"]').value = this.formData.submit_button_text || 'Gönder';
                    form.querySelector('[name="success_message"]').value = this.formData.success_message || '';
                }
            }

            closeFieldEditModal() {
                document.getElementById('field-edit-modal').classList.add('hidden');
                this.currentEditingField = null;
            }

            saveFieldEdit() {
                if (!this.currentEditingField) return;

                const form = document.getElementById('field-edit-form');
                const formData = new FormData(form);

                // Update field data
                this.currentEditingField.label = formData.get('label');
                this.currentEditingField.name = formData.get('name');
                this.currentEditingField.placeholder = formData.get('placeholder');
                this.currentEditingField.help_text = formData.get('help_text');
                this.currentEditingField.required = formData.get('required') === 'on';
                this.currentEditingField.width = formData.get('width');

                // Update options for select/radio/checkbox
                if (['select', 'radio', 'checkbox'].includes(this.currentEditingField.type)) {
                    const options = {};
                    const optionInputs = form.querySelectorAll('[name^="option_value_"]');
                    optionInputs.forEach((input, index) => {
                        const value = input.value;
                        const labelInput = form.querySelector(`[name="option_label_${index}"]`);
                        const label = labelInput ? labelInput.value : value;
                        if (value && label) {
                            options[value] = label;
                        }
                    });
                    this.currentEditingField.options = options;
                }

                // Update settings
                this.currentEditingField.settings = this.currentEditingField.settings || {};

                if (['rating', 'scale', 'slider'].includes(this.currentEditingField.type)) {
                    this.currentEditingField.settings.min = parseInt(formData.get('min_value')) || 1;
                    this.currentEditingField.settings.max = parseInt(formData.get('max_value')) || 5;
                }

                if (['file', 'image'].includes(this.currentEditingField.type)) {
                    this.currentEditingField.settings.max_size = parseInt(formData.get('max_size')) || 5;
                    const acceptTypes = formData.get('accept_types');
                    this.currentEditingField.settings.accept = acceptTypes ? acceptTypes.split(',').map(t => t.trim()) : [];
                }

                if (this.currentEditingField.type === 'html') {
                    this.currentEditingField.settings.html_content = formData.get('html_content');
                }

                // Update display
                this.updateFieldDisplay(this.currentEditingField);

                // Close modal
                this.closeFieldEditModal();
            }
        }

        // Initialize form builder when page loads
        document.addEventListener('DOMContentLoaded', () => {
            const formBuilder = new FormBuilder();

            // Check if we need to load an existing form
            const urlParams = new URLSearchParams(window.location.search);
            const loadFormId = urlParams.get('load');

            if (loadFormId) {
                formBuilder.loadExistingForm(loadFormId);
            }
        });
    </script>
</body>
</html>
