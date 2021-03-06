import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TipoSelectComponent } from './tipo-select.component';

describe('TipoSelectComponent', () => {
  let component: TipoSelectComponent;
  let fixture: ComponentFixture<TipoSelectComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TipoSelectComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TipoSelectComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
