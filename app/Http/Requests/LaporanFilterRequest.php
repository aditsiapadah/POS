<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'jenis' => $this->input('jenis', 'harian'),
            'tanggal' => $this->input('tanggal', now()->format('Y-m-d')),
            'bulan' => $this->input('bulan', now()->format('Y-m')),
        ]);
    }

    public function rules(): array
    {
        return [
            'jenis' => ['required', 'in:harian,mingguan,bulanan,rentang'],
            'tanggal' => ['nullable', 'required_if:jenis,harian,mingguan', 'date'],
            'bulan' => ['nullable', 'required_if:jenis,bulanan', 'date_format:Y-m'],
            'tanggal_awal' => ['nullable', 'required_if:jenis,rentang', 'date'],
            'tanggal_akhir' => ['nullable', 'required_if:jenis,rentang', 'date', 'after_or_equal:tanggal_awal'],
            'kasir_id' => ['nullable', 'integer', 'exists:users,id'],
            'metode_pembayaran' => ['nullable', 'in:CASH,TRANSFER,QRIS'],
            'search' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_awal.required_if' => 'Tanggal awal wajib diisi untuk rentang khusus.',
            'tanggal_akhir.required_if' => 'Tanggal akhir wajib diisi untuk rentang khusus.',
            'tanggal_akhir.after_or_equal' => 'Tanggal akhir tidak boleh sebelum tanggal awal.',
        ];
    }
}
