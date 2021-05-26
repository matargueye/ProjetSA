import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-side-bare',
  templateUrl: './side-bare.component.html',
  styleUrls: ['./side-bare.component.scss']
})
export class SideBareComponent implements OnInit {
  showFiller = false;

  constructor() { }

  ngOnInit(): void {
  }

}
