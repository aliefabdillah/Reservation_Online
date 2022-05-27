# API Spec

## WEB USER
==========
### NAVBAR
  - Button Dropdown Profile :
    -Logout ==> signIn.blade (userLogout);
    
### 1. landing.blade.
   -Pesan Sekarang ==> formTmptDuduk.blade (tmptDuduk)

### 2. formTmptDuduk.blade
   - Submit ==>
	if belum login ==> signIn.blade (signIn)
	else udah login ==> menu.blade (menu)

### 3. signIn.blade
   - Register Now! ==> register.blade (register)
   - Login ==> formTmptDuduk.blade (tmptDuduk)

### 3.1 register.blade
   - Register ==> (submit.register)
   - Conditional
	if register succes: Kembali ke Halaman Login ==> sigIn.blade (signIn) 
	if failed : tetep di halaman register 

### 4. menu.blade
   - Checkout ==> invoice.blade(invoice)

### 5. invoice.blade
   - Bayar ==> Tampilan Midtrans
   - Saya Sudah Bayar
	if success ==> validationSucces.blade (validation)
	else failed ==> validationFailed.blade (validation)

### 6. validationSuccess.blade
   - Kembali Ke Beranda ==> landing.blade (landing)

### 6.1 validationFailed.blade
   - Kembali ==> invoice.blade (invoice)  


## WEB ADMIN
=================
### 1. loginAdmin.blade
   - Submit ==> tableTmptDuduk.blade (tableTmptDuduk)

### 2. tableTmptDuduk.blade
   - Update Status ==> (updateStatus)
