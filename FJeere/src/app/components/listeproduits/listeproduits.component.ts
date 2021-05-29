import { Component, OnInit ,ViewChild} from '@angular/core';
import { ProduitsService } from 'src/app/services/produits.service';
import {MatTableDataSource} from '@angular/material/table';
import {MatPaginator} from '@angular/material/paginator';

@Component({
  selector: 'app-listeproduits',
  templateUrl: './listeproduits.component.html',
  styleUrls: ['./listeproduits.component.scss']
})
export class ListeproduitsComponent implements OnInit {
  produits = [];
 
  urlimg = 'data:image/png;base64,';
  constructor(private listeproduit:ProduitsService) { }


  ngOnInit(): void {
  
    this.listeproduit.getAllProduits().subscribe( produits => {
        this. produits =  produits;
        console.log(this. produits);
        
    });
  }
    
  }


