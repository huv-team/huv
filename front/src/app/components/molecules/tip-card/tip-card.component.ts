import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-tip-card',
  templateUrl: './tip-card.component.html',
  styleUrls: ['./tip-card.component.scss']
})
export class TipCardComponent implements OnInit {

  @Input() title:string;
  @Input() content:string;
  
  constructor() { }

  ngOnInit(): void {
  }

}
