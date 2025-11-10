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
            // app/Helpers/translation.php → TAMBAHKAN DI AKHIR

            // === DASHBOARD ===
            'Selamat datang' => ['id' => 'Selamat datang', 'en' => 'Welcome', 'ja' => 'ようこそ'],
            'Pilih menu di bawah untuk melanjutkan.' => [
                'id' => 'Pilih menu di bawah untuk melanjutkan.',
                'en' => 'Choose a menu below to continue.',
                'ja' => '下のメニューを選択して続行してください。'
            ],
            'Dashboard User' => ['id' => 'Dashboard User', 'en' => 'User Dashboard', 'ja' => 'ユーザー・ダッシュボード'],
            'Dashboard' => ['id' => 'Dashboard', 'en' => 'Dashboard', 'ja' => 'ダッシュボード'],
            'Lihat dan kelola data pendaftaran Anda' => [
                'id' => 'Lihat dan kelola data pendaftaran Anda',
                'en' => 'View and manage your registration data',
                'ja' => '登録データを確認・管理する'
            ],
            'Data Pendaftaran' => [
                'id' => 'Data Pendaftaran',
                'en' => 'Registration Data',
                'ja' => '登録データ'
            ],
                        // === PROGRAM ===
            'GINOU JISSHUUSEI' => [
                'id' => 'GINOU JISSHUUSEI',
                'en' => 'Technical Intern Training',
                'ja' => '技能実習生'
            ],
            'TOKUTEI GINOU (MANDIRI)' => [
                'id' => 'TOKUTEI GINOU (MANDIRI)',
                'en' => 'Specified Skilled Worker (Independent)',
                'ja' => '特定技能（独立）'
            ],

            // === STATUS ===
            'pending' => ['id' => 'Menunggu', 'en' => 'Pending', 'ja' => '審査中'],
            'approved' => ['id' => 'Disetujui', 'en' => 'Approved', 'ja' => '承認済み'],
            'rejected' => ['id' => 'Ditolak', 'en' => 'Rejected', 'ja' => '拒否'],
            'Edit' => ['id' => 'Edit', 'en' => 'Edit', 'ja' => '編集'],
            'Hapus' => ['id' => 'Hapus', 'en' => 'Delete', 'ja' => '削除'],
            'Yakin ingin menghapus?' => [
                'id' => 'Yakin ingin menghapus?',
                'en' => 'Are you sure you want to delete?',
                'ja' => '削除してもよろしいですか？'
            ],
            'Pendaftaran berhasil diperbarui!' => [
                'id' => 'Pendaftaran berhasil diperbarui!',
                'en' => 'Registration updated successfully!',
                'ja' => '登録が正常に更新されました！'
            ],
            'Pendaftaran berhasil dihapus!' => [
                'id' => 'Pendaftaran berhasil dihapus!',
                'en' => 'Registration deleted successfully!',
                'ja' => '登録が正常に削除されました！'
            ],
            'Aksi tidak diizinkan.' => [
                'id' => 'Aksi tidak diizinkan.',
                'en' => 'Action not allowed.',
                'ja' => '許可されていない操作です。'
            ],
            'Edit Pendaftaran' => ['id' => 'Edit Pendaftaran', 'en' => 'Edit Registration', 'ja' => '登録を編集'],
            'Simpan Perubahan' => ['id' => 'Simpan Perubahan', 'en' => 'Save Changes', 'ja' => '変更を保存'],
            'Kembali' => ['id' => 'Kembali', 'en' => 'Back', 'ja' => '戻る'],
            'Foto saat ini:' => ['id' => 'Foto saat ini:', 'en' => 'Current photo:', 'ja' => '現在の写真：'],
            // === ADMIN ===
            'Admin - Manajemen Pendaftaran' => ['id' => 'Admin - Manajemen Pendaftaran', 'en' => 'Admin - Registration Management', 'ja' => '管理者 - 登録管理'],
            'Manajemen Pendaftaran' => ['id' => 'Manajemen Pendaftaran', 'en' => 'Registration Management', 'ja' => '登録管理'],
            'Pendaftaran disetujui!' => ['id' => 'Pendaftaran disetujui!', 'en' => 'Registration approved!', 'ja' => '登録が承認されました！'],
            'Pendaftaran ditolak!' => ['id' => 'Pendaftaran ditolak!', 'en' => 'Registration rejected!', 'ja' => '登録が拒否されました！'],
            'Setujui' => ['id' => 'Setujui', 'en' => 'Approve', 'ja' => '承認'],
            'Tolak' => ['id' => 'Tolak', 'en' => 'Reject', 'ja' => '拒否'],
            'Setujui pendaftaran ini?' => ['id' => 'Setujui pendaftaran ini?', 'en' => 'Approve this registration?', 'ja' => 'この登録を承認しますか？'],
            'Tolak pendaftaran ini?' => ['id' => 'Tolak pendaftaran ini?', 'en' => 'Reject this registration?', 'ja' => 'この登録を拒否しますか？'],
            'Selesai' => ['id' => 'Selesai', 'en' => 'Done', 'ja' => '完了'],
            'Kembali ke User' => ['id' => 'Kembali ke User', 'en' => 'Back to User', 'ja' => 'ユーザーに戻る'],
            'Akses ditolak. Anda bukan admin.' => ['id' => 'Akses ditolak. Anda bukan admin.', 'en' => 'Access denied. You are not an admin.', 'ja' => 'アクセスが拒否されました。管理者ではありません。'],
            'Pendaftaran' => ['id' => 'Pendaftaran', 'en' => 'Registration', 'ja' => '登録'],
            'Manajemen Pendaftaran' => ['id' => 'Manajemen Pendaftaran', 'en' => 'Registration Management', 'ja' => '登録管理'],
            'Kelola pendaftaran program ke Jepang' => [
                'id' => 'Kelola pendaftaran program ke Jepang',
                'en' => 'Manage your Japan program registrations',
                'ja' => '日本プログラムの登録を管理'
            ],
            'Buat Baru' => ['id' => 'Buat Baru', 'en' => 'Create New', 'ja' => '新規作成'],
            'Nama' => ['id' => 'Nama', 'en' => 'Name', 'ja' => '名前'],
            'Tgl Lahir' => ['id' => 'Tgl Lahir', 'en' => 'Birth Date', 'ja' => '生年月日'],
            'Lahir' => ['id' => 'Lahir', 'en' => 'Born', 'ja' => '出生'],
            'Mulai daftar program ke Jepang sekarang!' => [
                'id' => 'Mulai daftar program ke Jepang sekarang!',
                'en' => 'Start registering for Japan programs now!',
                'ja' => '今すぐ日本プログラムに登録しましょう！'
            ],
            'Daftar Sekarang' => ['id' => 'Daftar Sekarang', 'en' => 'Register Now', 'ja' => '今すぐ登録'],
        ];


        // Pastikan $text ada di kamus
        return $dict[$text][$lang] ?? $text;
    }
}