import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FuenteCardComponent } from './fuente-card.component';

describe('FuenteCardComponent', () => {
  let component: FuenteCardComponent;
  let fixture: ComponentFixture<FuenteCardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FuenteCardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FuenteCardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
