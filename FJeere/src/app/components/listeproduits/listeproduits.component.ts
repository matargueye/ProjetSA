import { Component, OnInit } from '@angular/core';
import { ProduitsService } from 'src/app/services/produits.service';

@Component({
  selector: 'app-listeproduits',
  templateUrl: './listeproduits.component.html',
  styleUrls: ['./listeproduits.component.scss']
})
export class ListeproduitsComponent implements OnInit {
  Produits = [];
  urlimg = 'data:image/png;base64,';
  dataMenus: any;
  constructor(private listeproduit:ProduitsService) { }

  ngOnInit(): void {

  this.listeproduit.getAllProduits()
  .subscribe( data => {
  this.Produits = data;
  console.log(data);
    

  });
}
 applyFilter(event: Event) {
  const filterValue = (event.target as HTMLInputElement).value;
  this.dataMenus.filter = filterValue.trim();
  
  }

}
