untuk proses upload>
semasa upload, sistem akan scan terus file.
then lepas siap scan, sistem akan simpan data file dlm dbase.
then baru encrypt file tadi utk store dkt server (dalam folder upload) ;
 so file yg  ada dkt server adalah version encrpted. means admin x boleh view atau dload balik file tu. hanya owner file shaja boleh dload balik file diorang.


 admin:

 boleh view scanned file result details dekat dashboard, overall files, safe files dan detected files. 
 admin perlu click file id, then systen akan redirect ke page result details.
 utk result details nisy tambah untuk bezakan part admin dgn member.
 member boleh upload, scan dah cek result
 admin boleh view result details.
 based on api ada beberapa virus scanner yg birustotal guna.
 cth : ALYac, avg.. so dkt result ni admin boleh cek dgn lebih details fail status..
 bila scan complete, sistem akan keluarkan result samada safe atau detected.
 utk cth file image normala tadi, file dia safe..

 utk try file yg ada malware, kita boleh try file2 software ccrack. biasa file2 ni akan detect malware..
 kalau bos ada sample file crack boleh try upload tkde tua..

baik2 saya share..file crack ni bos jgn double click.. sbb sy cek mmg ada malware...


bagi file yg detected as malware, user not allowed utk dload balik...

so, sistem akan auto set file as malware jika salah satu antivirus kenalpasti file sbagai maliciu.s

cth file tadi, File detected as malicious by 4 out of 69 antivirus engines.


utk api tu kalau tak silap boleh scan 100 file/hari..

so utk backup api..boleh register dkt sini:

https://www.virustotal.com/gui/user/zuhimi/apikey

07addf0ecfcecd4802fb50722744af10542c48633ef300a80944f129402267b6

so incase masa upload atau admin nak view scan result..tak keluar..
boleh ganti dgn api yg atas tu..
cth page yg kane gnt: upload_file.php dan result_details.php


API DETAILS:
Access level  Limited , standard free public API Upgrade to premium
Usage	Must not be used in business workflows, commercial products or services.
Request rate	4 lookups / min (4 REQUEST PER MINIT)
Daily quota	500 lookups / day (500 REQUEST SEHARI)
Monthly quota	15.5 K lookups / month


yg dlm folder "upload" smua file2 member yg upload utk scan..admin tak boleh view
encrypted technice yg kita guna adalah menggunakan AES256