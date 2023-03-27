
<!DOCTYPE html>
<html>
<body>
    
  

    <div class="congrats-course">
        {{-- <a href="#">
          Accounting and Finance 
        </a> --}}
        {{-- <a href="#">ABC</a> --}}
        <div class="congrats-letter">
            <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="150px"></a>
            <p>
                <?php echo date("l jS \of F Y"); ?>
                 <br> <br>
                Dear {{ $uname }}, <br> <br>
                ID number 213221, <br> <br>
                Subject: CONDITIONAL LETTER OF OFFER <br> <br>
                Congratulations! IBSUniversity is very pleased to inform you that your Application into the University for IBSUDAF Diploma in Accounting and Finance programme was successful. <br>
                This letter hereby grants you the privilege of Registering into your preferred study programme. Upon presentation of this letter at the Student Services Department (SSD), you are kindly asked to: <br>
                <ul>
                    <li>Also supply your original copies of Educational Qualifications and any other conditions applicable like Advanced Standing etc. for verification.</li>
                    <li>Only after verification of all your required documents, then the officer serving you will discuss your payment options and then issue your invoice and deposit slip. Payments for accommodation, transport and textbook can also be included upon request.</li>
                    <li>Using your deposit slip, kindly make your payments at the bank. We do not accept cash payments and thus you are requested to make a direct deposit at the bank.</li>
                    <li>Once you have made your payments, kindly come see us to register into your preferred units to study for this semester.​ ​</li>

                </ul>
                When you have successfully registered, you will receive, via your email, your Booking Confirmations of the units you will undertake. <br> <br>
                For more clarification, your Admissions Officer will be happy to answer your doubts at the SSD, or via email, <a href="#">ask@ibs.ac.pg</a>, or call on +675 7411 4100 (D).​ <br>
                Once again, we thank you for choosing and welcome you to our educational family.
            </p>
        </div>
      </div>
    
</body>
</html>