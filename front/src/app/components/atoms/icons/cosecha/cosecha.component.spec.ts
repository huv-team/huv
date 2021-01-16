import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CosechaComponent } from './cosecha.component';

describe('CosechaComponent', () => {
  let component: CosechaComponent;
  let fixture: ComponentFixture<CosechaComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CosechaComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CosechaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
