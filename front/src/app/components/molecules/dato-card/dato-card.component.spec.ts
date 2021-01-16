import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DatoCardComponent } from './dato-card.component';

describe('DatoCardComponent', () => {
  let component: DatoCardComponent;
  let fixture: ComponentFixture<DatoCardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DatoCardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DatoCardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
