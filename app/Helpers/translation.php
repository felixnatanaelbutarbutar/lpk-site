<?php

if (!function_exists('translateField')) {
    function translateField($model, $field)
    {
        $lang = app()->getLocale();
        return $model->getTranslated($field, $lang);
    }
}

if (!function_exists('translateText')) {
    function translateText($text)
    {
        $lang = app()->getLocale();

        // KAMUS: Semua label + enum + status
        $dict = [
            // === HALAMAN ===
            'Data Pendaftaran Anda' => ['id' => 'Data Pendaftaran Anda', 'en' => 'Your Registration Data', 'ja' => 'あなたの登録データ'],
            'Buat Pendaftaran Baru' => ['id' => 'Buat Pendaftaran Baru', 'en' => 'Create New Registration', 'ja' => '新しい登録を作成'],
            'Lihat Detail' => ['id' => 'Lihat Detail', 'en' => 'View Detail', 'ja' => '詳細を見る'],
            'Belum diunggah' => ['id' => 'Belum diunggah', 'en' => 'Not uploaded', 'ja' => '未アップロード'],
            'Belum ada data pendaftaran.' => ['id' => 'Belum ada data pendaftaran.', 'en' => 'No registration data yet.', 'ja' => '登録データはまだありません。'],

            // === LABEL FIELD ===
            'Nama Lengkap' => ['id' => 'Nama Lengkap', 'en' => 'Full Name', 'ja' => 'フルネーム'],
            'Tempat Lahir' => ['id' => 'Tempat Lahir', 'en' => 'Place of Birth', 'ja' => '出生地'],
            'Tanggal Lahir' => ['id' => 'Tanggal Lahir', 'en' => 'Date of Birth', 'ja' => '生年月日'],
            'Jenis Kelamin' => ['id' => 'Jenis Kelamin', 'en' => 'Gender', 'ja' => '性別'],
            'Pendidikan Terakhir' => ['id' => 'Pendidikan Terakhir', 'en' => 'Last Education', 'ja' => '最終学歴'],
            'Alamat KTP' => ['id' => 'Alamat KTP', 'en' => 'ID Card Address', 'ja' => '身分証明書の住所'],
            'Belajar Bahasa Jepang' => ['id' => 'Belajar Bahasa Jepang', 'en' => 'Japanese Study', 'ja' => '日本語学習'],
            'Tempat Belajar' => ['id' => 'Tempat Belajar', 'en' => 'Study Place', 'ja' => '学習場所'],
            'Pernah ke Jepang' => ['id' => 'Pernah ke Jepang', 'en' => 'Been to Japan', 'ja' => '日本に行ったことがありますか'],
            'Tujuan ke Jepang' => ['id' => 'Tujuan ke Jepang', 'en' => 'Purpose to Japan', 'ja' => '日本への目的'],
            'Sumber Info' => ['id' => 'Sumber Info', 'en' => 'Info Source', 'ja' => '情報源'],
            'Nomor WhatsApp' => ['id' => 'Nomor WhatsApp', 'en' => 'WhatsApp Number', 'ja' => 'WhatsApp番号'],
            'Foto KTP' => ['id' => 'Foto KTP', 'en' => 'ID Photo', 'ja' => '身分証明書の写真'],
            'Status' => ['id' => 'Status', 'en' => 'Status', 'ja' => 'ステータス'],
            'Dibuat' => ['id' => 'Dibuat', 'en' => 'Created', 'ja' => '作成日'],
            'Aksi' => ['id' => 'Aksi', 'en' => 'Action', 'ja' => 'アクション'],

            // === ENUM VALUES ===
            'Pernah' => ['id' => 'Pernah', 'en' => 'Yes', 'ja' => 'はい'],
            'Tidak Pernah' => ['id' => 'Tidak Pernah', 'en' => 'No', 'ja' => 'いいえ'],
            'Laki-laki' => ['id' => 'Laki-laki', 'en' => 'Male', 'ja' => '男性'],
            'Perempuan' => ['id' => 'Perempuan', 'en' => 'Female', 'ja' => '女性'],
            'Aktif' => ['id' => 'Aktif', 'en' => 'Active', 'ja' => '有効'],
            'Nonaktif' => ['id' => 'Nonaktif', 'en' => 'Inactive', 'ja' => '無効'],
            'Tidak ada' => ['id' => 'Tidak ada', 'en' => 'None', 'ja' => 'なし'],
        ];

        // Pastikan $text ada di kamus
        return $dict[$text][$lang] ?? $text;
    }
}