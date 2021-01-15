import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TrasplanteComponent } from './trasplante.component';

describe('TrasplanteComponent', () => {
  let component: TrasplanteComponent;
  let fixture: ComponentFixture<TrasplanteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TrasplanteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TrasplanteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
