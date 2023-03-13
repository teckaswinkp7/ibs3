
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="{{asset('assets/custom/profile.css')}}">
<style>
    *{
   list-style-type: none;
}

    .congrats-btn {
    text-align: right;
}
.proinvoice-btn > a{

    color:white;
    text-decoration:none;

}
.congrats-btn button{
    padding: 12px 35px;
    background-color: #cc6600;
    color: white;
    transition: background .4s ease;
    border-radius: 10px;
    border: none;
}

.congrats-btn button:hover{
    background-color: black;
    color: white;

}

.congrats-btn button{
    padding: 10px 30px;
    background-color: #cc6600;
    color: white;
    transition: background .4s ease;
    border: none;
}

.congrats-btn button:hover{
    background-color: black;
    color: white;

}

.congrats-course > a{
    display: block;
    height: 100%;
    padding: 12px;
    text-decoration: none;
    margin-bottom: 2px;
    border-radius: 6px;
    color: rgba(0, 0, 0, 0.8);
    background-color: white;
    transition: all .3s ease;
    border: 1px solid #d9d9d9;
   }

   .congrats-letter{
    padding: 10px;
    background-color: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(0, 0, 0, 0.6);
    border-radius: 6px;
   }

   .congrats-letter ul{
    list-style: number;
   }
   .print-download-btn{
    margin-top: 30px;
   }

   .print-download-btn button{
    padding: 3px 6px;
    background-color: #cc6600;
    color: white;
    transition: background .4s ease;
    border: none;
}

.print-download-btn button:hover{
    background-color: black;
    color: white;

}
</style>
             
                       
                        <div class="congrats-letter">
                            <a href="#"><img src="{{asset('assets/custom/profile-logo.png')}}" alt="" width="150px"></a>
                            <p>
                                <?php echo date("l jS \of F Y"); ?>
                                 <br> <br>
                                Dear {{$student_course_offer[0]->uname}}, <br> <br>
                                ID number 213221, <br> <br>
                                Subject: CONDITIONAL LETTER OF OFFER <br> <br>
                                Congratulations! IBSUniversity is very pleased to inform you that your Application into the University for IBSUDAF {{$student_course_offer[0]->courses_name}} programme was successful. <br>
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

                </div>
            </div>
            
        </div>
    </div>
  