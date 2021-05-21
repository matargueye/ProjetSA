import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { AuthentificationService } from 'src/app/services/authentification.service';

@Component({
  selector: 'app-authentification',
  templateUrl: './authentification.component.html',
  styleUrls: ['./authentification.component.scss']
})
export class AuthentificationComponent implements OnInit {

  loginForm: FormGroup;
  loading = false;
  submitted = false;
  returnUrl: string;
  error = '';
  formConnexion: any;

  constructor(
      private formBuilder: FormBuilder,
      private route: ActivatedRoute,
      private router: Router,
      private authenticationService: AuthentificationService
  ) { 
      // redirect to home if already logged in
    
  }

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      username: ['', Validators.required],
      password: ['', Validators.required]
  });
  }
  onSubmit(){
    const  user = {
      username: this.loginForm.value.username,
      password: this.loginForm.value.password,
  };
  this.authenticationService.login(user).subscribe(
    data => {
      console.log(data);
      this.router.navigate(['/']);
    },
    error => {
     /* this.errorMessage = 'username ou mot de passe incorrect';*/
      console.log(error);

  });
  }

}
