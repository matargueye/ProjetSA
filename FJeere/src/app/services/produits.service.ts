import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { Produit } from '../models/produit';


@Injectable({
  providedIn: 'root'
})
export class ProduitsService {

  constructor(private http:HttpClient) {}
  ListeProduits(data:any){
    return this.http.get<any[]>(`${environment.apiUrl}/api/produits`,data);
   
  }
  

}
