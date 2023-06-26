<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_perkara_pidsus extends M_perkara {
    public function rules()
    {
        return [
            ['field' => 'pulbaket_no', 'label' => 'PULBAKET NO/ TGL/NAMA JAKSA', 'rules' => 'required'],
            ['field' => 'penyelidik_no', 'label' => 'PENYELIDIKAN NO/ TGL/NAMA JAKSA','rules' => 'required'],
            ['field' => 'penyidikan_no', 'label' => 'PENYIDIKAN SPDP & P-16 NO/ TGL/NAMA JAKSA','rules' => 'required'],
            ['field' => 'instansi_asal', 'label' => 'INSTANSI ASAL','rules' => 'required'],
            ['field' => 'nama_tsk', 'label' => 'NAMA TSK/TDKW/TPDANA','rules' => 'required'],
            ['field' => 'pasal_tsk', 'label' => 'PASAL DISANGKA/DIDAKWA/DITUNTUT/TERBUKTI','rules' => 'required'],
            ['field' => 'jenis_perkara', 'label' => 'JENIS PERKARA/ PERMASALAHAN','rules' => 'required'],
            ['field' => 'tahap_1', 'label' => 'TAHAP 1','rules' => 'required'],
            ['field' => 'tahap_1_proses', 'label' => 'P-18/P-19/P-21','rules' => 'required'],
            ['field' => 'tahap_2', 'label' => 'TAHAP II & P-16A NO/TGL/NAMA JAKSA','rules' => 'required'],
            ['field' => 'limpah_pn', 'label' => 'LIMPAH PN','rules' => 'required'],
            ['field' => 'putus_pn', 'label' => 'PUTUS PN','rules' => 'required'],
            ['field' => 'banding_pn', 'label' => 'BANDING','rules' => 'required'],
            ['field' => 'kasasi_pn', 'label' => 'KASASI','rules' => 'required'],
            ['field' => 'eksekusi_pn', 'label' => 'EKSEKUSI'],
            ['field' => 'grasi_pn', 'label' => 'GRASI'],
            ['field' => 'pk_pn', 'label' => 'PK'],
            ['field' => 'pekating_pn', 'label' => 'PEKATING'],
            ['field' => 'description', 'label' => 'KETERANGAN']
        ];
    }
}