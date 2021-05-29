import { AuthentificationComponent } from './components/authentification/authentification.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CompteClientComponent } from './components/compte-client/compte-client.component';
import { ListeproduitsComponent } from './components/listeproduits/listeproduits.component';
import { HeaderComponent } from './components/header/header.component';
import { SideBareComponent } from './components/side-bare/side-bare.component';
import { FooterComponent } from './components/footer/footer.component';
import { AcceuilleComponent } from './pages/acceuille/acceuille.component';


const routes: Routes = [
  {
    path:'acceuille',
    component: AcceuilleComponent
  },
  {
    path:'compte_client',
    component: CompteClientComponent
  },
  {
    path:'liste_produits',
    component:ListeproduitsComponent
  },
  {
    path:'header',
    component: HeaderComponent
  },
  {
    path:'sidBire',
    component:SideBareComponent
  },
  {
    path:'footer',
    component:FooterComponent
  },
  
  
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
