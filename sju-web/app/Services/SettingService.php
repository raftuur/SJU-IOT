<?php

namespace App\Services;

use App\Models\SettingModel;

class SettingService
{
    protected SettingModel $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    /**
     * Ambil satu setting berdasarkan key
     */
    public function get(string $key, $default = null)
    {
        $setting = $this->settingModel
            ->where('key', $key)
            ->first();

        if (! $setting) {
            return $default;
        }

        return $setting['value'];
    }

    /**
     * Ambil semua setting
     */
    public function getAll(): array
    {
        return $this->settingModel
            ->orderBy('group', 'ASC')
            ->orderBy('key', 'ASC')
            ->findAll();
    }

    /**
     * Ambil setting berdasarkan group
     */
    public function getByGroup(string $group): array
    {
        return $this->settingModel
            ->where('group', $group)
            ->orderBy('key', 'ASC')
            ->findAll();
    }

    /**
     * Simpan atau update setting
     */
    public function set(
        string $key,
        $value,
        string $group,
        ?string $description = null
    ): bool {

        $existing = $this->settingModel
            ->where('key', $key)
            ->first();

        $data = [
            'key'         => $key,
            'value'       => (string) $value,
            'group'       => $group,
            'description' => $description,
        ];

        if ($existing) {

            return $this->settingModel
                ->update($existing['id'], $data);

        }

        return (bool) $this->settingModel
            ->insert($data);
    }

    /**
     * Simpan beberapa setting sekaligus
     */
    public function setMultiple(array $settings): bool
    {
        foreach ($settings as $setting) {

            $this->set(
                $setting['key'],
                $setting['value'],
                $setting['group'],
                $setting['description'] ?? null
            );

        }

        return true;
    }
}