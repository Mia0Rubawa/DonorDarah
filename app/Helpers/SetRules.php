<?php

namespace App\Helpers;

class SetRules
{
    public static function setRules($array_data)
    {
        $rules = [];
        $messages = [];
        foreach ($array_data as $k_input => $d_input) {
            $rules[$k_input] = ['required', 'min:4'];
            switch ($k_input) {
                case 'email':
                    $rules[$k_input] = array_merge($rules[$k_input], ['email']);
                    break;
                case 'password':
                    $rules[$k_input] = array_merge($rules[$k_input]);
                    break;
                default:
            }
            $ruleSet = is_array($rules[$k_input]) ?  $rules[$k_input] : explode('|',  $rules[$k_input]);

            foreach ($rules[$k_input] as $set_messages) {
                [$ruleName, $parameter] = array_pad(explode(':', $set_messages, 2), 2, null);
                $pesan = '';
                switch ($ruleName) {
                    case 'required':
                        $pesan =  "Field '{$k_input}' wajib diisi.\n";
                        break;

                    case 'min':
                        $pesan = "Field '{$k_input}' harus memiliki nilai atau panjang minimal {$parameter} karakter.\n";
                        break;

                    case 'max':
                        $pesan =  "Field '{$k_input}' harus memiliki nilai atau panjang maksimal {$parameter} karakter.\n";
                        break;

                    case 'email':
                        $pesan = "Field '{$k_input}' harus berupa alamat email yang valid.\n";
                        break;

                    case 'string':
                        $pesan =  "Field '{$k_input}' harus berupa teks.\n";
                        break;

                    case 'numeric':
                        $pesan = "Field '{$k_input}' harus berupa angka.\n";
                        break;

                    case 'confirmed':
                        $pesan = "Field '{$k_input}' membutuhkan field konfirmasi.\n";
                        break;

                    default:
                        $pesan =  "Field '{$k_input}' memiliki aturan yang tidak terdefinisi: {$ruleName}.\n";
                        break;
                }

                $messages[$k_input . '.' . $ruleName] = $pesan;
            }
        }
        return ['rules' => $rules, 'messages' => $messages];
    }
}
