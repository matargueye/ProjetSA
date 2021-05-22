import { AuthentificationComponent } from './components/authentification/authentification.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CompteClientComponent } from './components/compte-client/compte-client.component';

const routes: Routes = [
  {
    path:'login',
    component: AuthentificationComponent
  },
  {
    path:'compte_client',
    component: CompteClientComponent
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
