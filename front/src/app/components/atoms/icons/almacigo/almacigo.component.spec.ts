import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AlmacigoComponent } from './almacigo.component';

describe('AlmacigoComponent', () => {
  let component: AlmacigoComponent;
  let fixture: ComponentFixture<AlmacigoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AlmacigoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AlmacigoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
